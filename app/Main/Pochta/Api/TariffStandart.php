<?php

namespace App\Main\Pochta\Api;

class TariffStandart extends PochtaAbstract
{
    public array $params = [
        'object' => 27030,
        'from' => '',
        'to' => '',
        'weight' => 500,
        'pack' => 10
    ];

    public function apply(): \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
    {
        return $this->get();
    }
}
