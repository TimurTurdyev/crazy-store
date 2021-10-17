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
        $total = $this->order->totals()->where('code', 'total')->first();
        return [
            'message' => sprintf(config('main.sber.text', ''), $this->order->firstname, $total?->value)
        ];
    }

    #[ArrayShape(['message' => "string"])] public function tinkoff_pay(): array
    {
        $tinkoff = new TinkoffClient();
        $response = $tinkoff->setTest(true)->init($this->order)->collect();
        $payment_url = $response->get('PaymentURL', '');
        $total = $this->order->totals()->where('code', 'total')->first();

        if ($payment_url === '') {
            return [
                'message' => 'Произошла ошибка в формировании ссылки на оплату',
            ];
        }

        return [
            'message' => sprintf(
                'Сумма оплаты %s руб. Ссылка на онлайн оплату %s',
                $total?->value,
                $response->get('PaymentURL', ''),
            )
        ];
    }
}
