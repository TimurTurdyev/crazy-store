<?php

namespace App\Main\Tinkoff\Api;

class InitApi extends BaseAbstract
{
    private static string $path = 'Init';

    public function apply(): \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
    {
        return $this->post(static::$path);
    }
}
