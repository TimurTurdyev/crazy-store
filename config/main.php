<?php

return [
    'cdek' =>  [
        'account' => env('cdek_account', ''),
        'secure' => env('cdek_secure', ''),
        'postal_code' => env('cdek_postal_code', ''),
    ],
    'sber' => [
        'card' => env('sber_card'),
        'text' => env('sber_text'),
    ],
    'tinkoff' => [
        'terminal_key' => env('tinkoff_terminal_key', ''),
        'secret_key' => env('tinkoff_terminal_key', ''),
    ],
    'order' => [
        '0' => 'Ожидание',
        '1' => 'Отменено',
        '20' => 'Ожидает товар',
        '30' => 'Ожидает доставки',
        '31' => 'Почта - Ожидает отправления',
        '32' => 'Отправлен почтой России',
        '33' => 'CDEK - Ожидает отправления',
        '34' => 'Отправлен ТК СДЭК',
        '40' => 'Ожидаем оплаты',
        '41' => 'Ожидает подтверждения оплаты',
        '42' => 'Оплачено',
        '99' => 'Доставлено',
    ],
    'home' => [
        'title' => env('home_title'),
        'description' => env('home_description'),
    ],
    'email' => env('email', ''),
    'phone' => env('phone', ''),
];