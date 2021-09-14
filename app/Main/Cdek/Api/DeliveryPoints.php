<?php

namespace App\Main\Cdek\Api;

class DeliveryPoints extends CdekAbstract
{
    private static string $uri_path = 'deliverypoints';

    public function apply(): \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
    {
        return $this->get(static::$uri_path);
    }
}
