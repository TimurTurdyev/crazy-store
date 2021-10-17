<?php

namespace App\Main\Tinkoff\Adapters;

use App\Main\Tinkoff\Constants;
use App\Main\Tinkoff\Interfaces\ParamsInterface;
use App\Models\Order;

class OrderTinkoffAdapter implements ParamsInterface
{
    private array $params;
    private Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;

        $total = $this->order->totals()->where('code', 'total')->first();

        $this->params = [
            'OrderId' => $this->order->id,
            'Amount' => $total->value * 100,
            'Description' => sprintf('Оплата заказа №%s', $this->order->id),
        ];

        $this->data();          // 1
        $this->receipt();       // 2
        $this->receiptItems();  // 3
//        dump($this->params);
    }

    public function getParams(): array
    {
        return $this->params;
    }

    private function data(): void
    {
        if ($this->order->email) {
            $this->params['DATA']['Email'] = $this->order->email;
        }
        if ($this->order->phone) {
            $this->params['DATA']['Phone'] = $this->order->phone;
        }
    }

    private function receipt(): void
    {
        $this->params['Receipt'] = [
            'Taxation' => Constants::TAXATION['usn_income'],
        ];

        if (!empty($this->params['DATA'])) {
            $this->params['Receipt'] = array_merge($this->params['Receipt'], $this->params['DATA']);
        }
    }

    private function receiptItems(): void
    {
        $receiptItems = [];
        $amount = 0;
        $promo = $this->order->totals()->where('code', 'promo')->first();
        $delivery = $this->order->totals()->where('code', 'delivery')->first();

        foreach ($this->order->items as $item) {
            $total = $item->price * $item->quantity * 100;
            $amount += $total;

            $receiptItems[] = [
                'Name' => $item->name,
                'Price' => $item->price * 100,
                'Quantity' => $item->quantity,
                'Amount' => $total,
                'PaymentMethod' => Constants::PAYMENT['full_prepayment'],
                'PaymentObject' => Constants::ENTITY['commodity'],
                'Tax' => Constants::VAT['none']
            ];
        }

        if ($amount && $promo && ($promo->value * 100) < 0) {
            $percent = 100 - (($amount + ($promo->value * 100)) * 100) / $amount;
            foreach ($receiptItems as &$item) {
                $item['Amount'] = $item['Amount'] - ($item['Amount'] * ($percent / 100));
            }
        }

        if ($delivery && $delivery->value) {
            $receiptItems[] = [
                'Name' => $delivery->title,
                'Price' => $delivery->value * 100,
                'Quantity' => 1,
                'Amount' => $delivery->value * 100,
                'PaymentMethod' => Constants::PAYMENT['full_prepayment'],
                'PaymentObject' => Constants::ENTITY['service'],
                'Tax' => Constants::VAT['none'],
            ];
        }

        if (count($receiptItems)) {
            $this->params['Receipt']['Items'] = $receiptItems;
        }
    }
}
