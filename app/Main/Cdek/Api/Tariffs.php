<?php

namespace App\Main\Cdek\Api;

class Tariffs extends CdekAbstract
{
    private static string $uri_path = 'calculator/tarifflist';

    public function apply(): \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
    {
        return $this->post(static::$uri_path);
    }
}
