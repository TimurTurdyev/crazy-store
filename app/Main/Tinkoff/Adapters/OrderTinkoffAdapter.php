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

        $this->params = [
            'OrderId' => $this->order->id,
            'Amount' => $this->order->total * 100,
            'Description' => sprintf('Оплата заказа №%s', $this->order->id),
        ];

        $this->data();          // 1
        $this->receipt();       // 2
        $this->receiptItems();  // 3
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

        foreach ($this->order->items as $item) {
            $receiptItems[] = [
                'Name' => $item->name,
                'Price' => $item->price * 100,
                'Quantity' => $item->quantity,
                'Amount' => $item->price * $item->quantity * 100,
                'PaymentMethod' => Constants::PAYMENT['full_prepayment'],
                'PaymentObject' => Constants::ENTITY['commodity'],
                'Tax' => Constants::VAT['none']
            ];
        }

        if ($this->order->promo_value) {
            $receiptItems[] = [
                'Name' => sprintf('Промокод - %s', $this->order->promo_code),
                'Price' => $this->order->promo_value * 100,
                'Quantity' => 1,
                'Amount' => $this->order->promo_value * 100,
                'PaymentMethod' => Constants::PAYMENT['full_prepayment'],
                'PaymentObject' => Constants::ENTITY['service'],
                'Tax' => Constants::VAT['none'],
            ];
        }

        if ($this->order->delivery_code) {
            $delivery = $this->order->getDeliveryAttribute();

            $receiptItems[] = [
                'Name' => $delivery['name'],
                'Price' => $delivery['value'] * 100,
                'Quantity' => 1,
                'Amount' => $delivery['value'] * 100,
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
