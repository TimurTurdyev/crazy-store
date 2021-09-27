<?php

namespace App\Repositories;

use App\Main\Tinkoff\TinkoffClient;
use App\Models\Order;
use JetBrains\PhpStorm\ArrayShape;

class PaymentRepository implements PaymentInterface
{
    private Order $order;

    public function message(Order $order): array
    {
        $this->order = $order;
        $method_name = str_replace('.', '_', $this->order->payment_code);

        if (method_exists($this, $method_name)) {
            return $this->{$method_name}();
        }
        return [];
    }

    #[ArrayShape(['message' => "string"])] public function sber_card(): array
    {
        return [
            'message' => sprintf(config('sber.text', ''), $this->order->total)
        ];
    }

    #[ArrayShape(['message' => "string"])] public function tinkoff_pay(): array
    {
        $tinkoff = new TinkoffClient($this->order);
        $response = $tinkoff->setTest(true)->init($this->order)->collect();

        return [
            'message' => sprintf(
                'Сумма оплаты %s руб. Ссылка на онлайн оплату %s',
                $this->order->total,
                $response->get('PaymentURL', ''),
            )
        ];
    }
}
