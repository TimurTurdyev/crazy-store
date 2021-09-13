<?php

namespace App\Main\Pochta\Api;

use Illuminate\Support\Facades\Http;

abstract class BaseAbstract
{
    protected string $api_url = 'https://tariff.pochta.ru/v2/calculate/tariff?json';

    protected array $params = [];

    private array $headers = [
        'Accept' => 'application/json',
        'Content-Type' => 'application/json',
    ];

    public function __construct(array $params = [])
    {
        foreach ($params as $key => $value) {
            if (isset($this->params[$key])) {
                $this->params[$key] = $value;
            }
        }
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function setHeaders(array $headers): BaseAbstract
    {
        $this->headers = $headers;
        return $this;
    }

    public function get(): \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
    {
        return Http::withHeaders($this->headers)->get(sprintf('%s&%s', $this->api_url, http_build_query($this->params)));
    }

    abstract public function apply();
}
