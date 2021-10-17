<?php

namespace App\Main\Tinkoff\Api;

use App\Main\Tinkoff\Constants;
use App\Main\Tinkoff\Interfaces\ParamsInterface;
use Illuminate\Support\Facades\Http;

abstract class TinkoffAbstract
{
    protected string $api_url;
    protected string $entity = '';

    protected array $params;

    private array $headers = [
        'Accept' => 'application/json',
        'Content-Type' => 'application/json',
    ];

    public function __construct(ParamsInterface $params)
    {
        $this->api_url = Constants::API_URL;

        $this->params = $params->getParams();
        $this->params['TerminalKey'] = config('main.tinkoff.terminal_key', '');
        $this->params['Token'] = $this->genToken();
    }

    public function test(): TinkoffAbstract
    {
        $this->api_url = Constants::API_TEST_URL;
        return $this;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function setHeaders(array $headers): TinkoffAbstract
    {
        $this->headers = $headers;
        return $this;
    }

    public function setEntity(string $entity): TinkoffAbstract
    {
        $this->entity = $entity;
        return $this;
    }

    public function genToken(): string
    {
        $token = '';

        $array_values = array_merge($this->params, ['Password' => config('main.tinkoff.secret_key', '')]);

        ksort($array_values);

        foreach ($array_values as $value) {
            if (!is_array($value)) {
                $token .= $value;
            }
        }

        return hash('sha256', $token);
    }

    public function getParams(): array
    {
        return $this->params;
    }

    public function getUrl(): string
    {
        return $this->api_url . $this->entity;
    }

    public function send(): \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
    {
        return Http::withHeaders($this->headers)->post($this->getUrl(), $this->getParams());
    }

    abstract public function apply();
}
