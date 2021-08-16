<?php

namespace App\Main\Cdek;

use App\Main\Cdek\Api\TariffsApi;

class Client
{
    private Login $login;

    public function __construct(Oauth $oauth)
    {
        $this->login = $oauth->authorize();
    }

    public function tariffs(array $params): array
    {
        return (new TariffsApi($this->login, $params))->apply();
    }
}
