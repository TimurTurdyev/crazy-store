<?php

namespace App\Main\Cdek\Api;

use Illuminate\Support\Facades\Http;
use App\Main\Cdek\Login;

abstract class BaseAbstract
{
    protected string $api_url = '';

    private array $headers = [
        'Accept' => 'application/json',
        'Content-Type' => 'application/json',
        'Authorization' => ''
    ];

    protected array $params = [];

    public function __construct(Login $login, array $params = [])
    {
        $this->params = $params;

        $this->api_url = $login->getApiUrl();
        $this->headers['Authorization'] = sprintf('Bearer %s', $login->getAccessToken());

        return $this;
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

    public function prepareParamsToQueryString(): string
    {
        $callback = fn(string $k, string $v): string => "$k=$v";
        $result = array_map($callback, array_keys($this->params), array_values($this->params));

        if (count($result)) {
            return '?' . join('&', $result);
        }

        return '';
    }

    public function get(string $api_url): array
    {
        return $this->response(Http::with($this->headers)->get($api_url));
    }

    public function post(string $api_url): array
    {
        return $this->response(Http::withHeaders($this->headers)->post($api_url, $this->params));
    }

    private function response($response): array
    {
        if ($response->ok()) {
            return $response->json() ?? [];
        }
        return [];
    }


    abstract public function apply();
}
