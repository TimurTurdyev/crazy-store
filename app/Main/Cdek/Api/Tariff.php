<?php

namespace App\Main\Cdek\Api;

use App\Main\Cdek\Login;
use JetBrains\PhpStorm\Pure;

class Tariff extends CdekAbstract
{
    private static string $uri_path = 'calculator/tariff';
    public array $params = [
        'type' => '1',
        //'date' => '2020-11-03T11:49:32+0700',
        'currency' => '1',
        'tariff_code' => '',
        'from_location' => [
            'postal_code' => '',
        ],
        'to_location' => [
            'postal_code' => ''
        ],
        'packages' => [
            [
                'height' => 20,
                'length' => 20,
                'weight' => 1000,
                'width' => 20
            ]
        ]
    ];

    public function apply(): \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
    {
        $this->params['from_location']['postal_code'] = config('main.cdek.postal_code', '');
        return $this->post(static::$uri_path);
    }
}
