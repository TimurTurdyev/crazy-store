<?php

namespace App\Main\Pochta\Api;

class Tariff1Class extends BaseAbstract
{
    public array $params = [
        'object' => 47030,
        'from' => '',
        'to' => '',
        'weight' => 500,
    ];

    public function apply(): \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
    {
        return $this->get();
    }
}
