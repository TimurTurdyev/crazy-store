<?php

namespace App\Main\Tinkoff\Api;

use App\Main\Tinkoff\Constants;
use App\Main\Tinkoff\Interfaces\ParamsInterface;
use Illuminate\Support\Facades\Http;

abstract class BaseAbstract
{
    protected string $api_url;
    protected array $params;
    private array $headers = [
        'Accept' => 'application/json',
        'Content-Type' => 'application/json',
    ];

    public function __construct(ParamsInterface $params)
    {
        $this->api_url = Constants::API_URL;

        $this->params = $params->getParams();
        $this->params['TerminalKey'] = config('tinkoff.terminal_key', '');
        $this->params['Token'] = $this->genToken();
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

    public function test(): BaseAbstract
    {
        $this->api_url = Constants::API_TEST_URL;
        return $this;
    }

    public function genToken(): string
    {
        $token = '';

        $array_values = array_merge($this->params, ['Password' => config('tinkoff.secret_key', '')]);

        ksort($array_values);

        foreach ($array_values as $value) {
            if (!is_array($value)) {
                $token .= $value;
            }
        }

        return hash('sha256', $token);
    }

    public function post(string $uri_path): \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
    {
        return Http::withHeaders($this->headers)->post($this->api_url . $uri_path, $this->params);
    }

    abstract public function apply();
}
