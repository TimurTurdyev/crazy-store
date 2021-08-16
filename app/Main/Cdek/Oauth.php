<?php

namespace App\Main\Cdek;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class Oauth
{
    private string $api_url;
    private string $account;
    private string $secure;

    public function __construct()
    {
        $this->api_url = Constants::API_URL;
        $this->account = config('cdek_account', '');
        $this->secure = config('cdek_secure', '');

        return $this;
    }

    public function test(): Oauth
    {
        $this->api_url = Constants::API_URL_TEST;
        $this->account = Constants::TEST_ACCOUNT;
        $this->secure = Constants::TEST_SECURE;
        return $this;
    }

    public function authorize(): Login
    {
        $headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/x-www-form-urlencoded',
        ];

        $param = [
            Constants::AUTH_KEY_TYPE => Constants::AUTH_PARAM_CREDENTIAL,
            Constants::AUTH_KEY_CLIENT_ID => $this->account,
            Constants::AUTH_KEY_SECRET => $this->secure,
        ];

        return new Login(
            $this->api_url,
            Cache::remember('cdek' . $this->secure, 60 * 60 - Constants::CONNECTION_TIMEOUT, function () use ($headers, $param) {
                $response = Http::withHeaders($headers)
                    ->post(sprintf('%s?%s', $this->api_url . 'oauth/token', http_build_query($param)));

                return $response->json();
            })
        );
    }
}
