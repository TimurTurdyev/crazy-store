<?php

namespace App\Main\Cdek\Api;

use Illuminate\Support\Facades\Http;
use App\Main\Cdek\Login;
use JetBrains\PhpStorm\Pure;

abstract class CdekAbstract
{
    protected string $api_url = '';

    protected array $params = [];

    private array $headers = [
        'Accept' => 'application/json',
        'Content-Type' => 'application/json',
        'Authorization' => ''
    ];

    #[Pure] public function __construct(Login $login, array $params = [])
    {
        foreach ($params as $k => $v) {
            $this->params[$k] = $v;
        }

        $this->api_url = $login->getApiUrl();
        $this->headers['Authorization'] = sprintf('Bearer %s', $login->getAccessToken());
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function setHeaders(array $headers): CdekAbstract
    {
        $this->headers = $headers;
        return $this;
    }

    public function get(string $uri_path): \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
    {
        return Http::withHeaders($this->headers)->get($this->api_url . $uri_path . '?' . http_build_query($this->params));
    }

    public function post(string $uri_path): \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
    {
        return Http::withHeaders($this->headers)->post($this->api_url . $uri_path, $this->params);
    }

    abstract public function apply();
}
