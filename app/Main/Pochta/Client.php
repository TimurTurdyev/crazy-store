<?php

namespace App\Main\Pochta;

use App\Main\Pochta\Api\Tariff1Class;
use App\Main\Pochta\Api\TariffStandart;
use Illuminate\Support\Facades\Http;

class Client
{
    public function tariffStandart(array $params): \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
    {
        return (new TariffStandart($params))->apply();
    }

    public function tariff1Class(array $params): \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
    {
        return (new Tariff1Class($params))->apply();
    }
}
