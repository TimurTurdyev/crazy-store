<?php

namespace App\Main\Cdek\Api;

class TariffsApi extends BaseAbstract
{
    public static string $uri_path = 'telecom/api/bs';

    public function apply(): array
    {
        return $this->post($this->api_url . static::$uri_path);
    }
}
