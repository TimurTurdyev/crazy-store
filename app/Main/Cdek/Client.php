<?php

namespace App\Main\Cdek;

use App\Main\Cdek\Api\DeliveryPointsApi;
use App\Main\Cdek\Api\TariffApi;
use App\Main\Cdek\Api\TariffsApi;

class Client
{
    private Login $login;

    public function __construct(Login $login)
    {
        $this->login = $login;
    }

    public function deliverypoints(array $params): \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
    {
        return (new DeliveryPointsApi($this->login, $params))->apply();
    }

    public function tariff(array $params): \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
    {
        return (new TariffApi($this->login, $params))->apply();
    }

    public function tariffs(array $params): \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
    {
        return (new TariffsApi($this->login, $params))->apply();
    }
}
