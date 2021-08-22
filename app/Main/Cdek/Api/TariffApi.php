<?php

namespace App\Main\Cdek\Api;

class TariffApi extends BaseAbstract
{
    private static string $uri_path = 'calculator/tariff';

    public function apply(): \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
    {
        return $this->post(static::$uri_path);
    }
}
