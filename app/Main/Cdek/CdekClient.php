<?php

namespace App\Main\Cdek;

use App\Main\Cdek\Api\DeliveryPoints;
use App\Main\Cdek\Api\Tariff;
use App\Main\Cdek\Api\Tariffs;

class CdekClient
{
    private Login $login;

    public function __construct(Login $login)
    {
        $this->login = $login;
    }

    public function deliverypoints(array $params): \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
    {
        return (new DeliveryPoints($this->login, $params))->apply();
    }

    public function tariff(array $params): \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
    {
        return (new Tariff($this->login, $params))->apply();
    }

    public function tariffs(array $params): \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
    {
        return (new Tariffs($this->login, $params))->apply();
    }
}
