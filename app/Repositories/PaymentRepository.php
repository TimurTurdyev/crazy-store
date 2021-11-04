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

        if (method_exists($this, $this->order->payment_code)) {
            return $this->{$this->order->payment_code}();
        }

        return ['message' => 'Выберите подходящий способ оплаты!'];
    }

    #[ArrayShape(['message' => "string"])] public function sber_card(): array
    {
        $total = $this->order->totals()->where('code', 'total')->first();
        return [
            'message' => sprintf(config('main.sber_card.text', ''), $this->order->firstname, $total?->value)
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

        $payment_url = sprintf('<a href="%s">Перейти к оплате</a>', $payment_url);
        return [
            'message' => sprintf(
                'Сумма оплаты %s руб. Ссылка на онлайн оплату %s',
                $total?->value,
                $payment_url,
            )
        ];
    }
}
