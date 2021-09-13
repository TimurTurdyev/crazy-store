<?php

namespace App\Main\Tinkoff\Adapters;

use App\Main\Tinkoff\Constants;
use App\Main\Tinkoff\Interfaces\ParamsInterface;
use App\Models\Order;

class OrderAdapter implements ParamsInterface
{
    private array $params;
    private Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;

        $this->params = [
            'OrderId' => $this->order->id,
            'Amount' => $this->order->total,
            'Description' => sprintf('Оплата заказа №%s', $this->order->id),
        ];

        $this->setData();   // 1
        $this->setReceipt();// 2
        $this->setItems();  // 3
    }

    public function getParams(): array
    {
        return $this->params;
    }

    private function setData(): void
    {
        if ($this->order->email) {
            $this->params['DATA']['Email'] = $this->order->email;
        }
        if ($this->order->phone) {
            $this->params['DATA']['Phone'] = $this->order->phone;
        }
    }

    private function setReceipt(): void
    {
        $this->params['Receipt'] = [
            'Taxation' => Constants::VAT['none'],
        ];

        if (!empty($this->params['DATA'])) {
            $this->params['Receipt'] = array_merge($this->params['Receipt'], $this->params['DATA']);
        }
    }

    private function setItems(): void
    {
        $receiptItem = [];

        foreach ($this->order->items as $item) {
            $receiptItem[] = [
                'Name' => $item->name,
                'Price' => $item->price * 100,
                'Quantity' => $item->quantity,
                'Amount' => $item->price * $item->quantity * 100,
                'PaymentMethod' => Constants::PAYMENT['full_prepayment'],
                'PaymentObject' => Constants::ENTITY['commodity'],
                'Tax' => Constants::VAT['none']
            ];
        }

        if ($this->order->delivery_code) {
            $delivery = $this->order->getDeliveryAttribute();

            $receiptItem[] = [
                'Name' => $delivery['name'],
                'Price' => $delivery['value'] * 100,
                'Quantity' => 1,
                'Amount' => $delivery['value'] * 100,
                'PaymentMethod' => Constants::PAYMENT['full_prepayment'],
                'PaymentObject' => Constants::ENTITY['service'],
                'Tax' => Constants::VAT['none'],
            ];
        }

        if ($receiptItem) {
            $this->params['Receipt']['Items'] = $receiptItem;
        }
    }
}
