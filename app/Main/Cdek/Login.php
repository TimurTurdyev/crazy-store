<?php

namespace App\Main\Cdek;

class Login
{
    private string $api_url;
    private string $access_token;
    private string $token_type;
    private string $scope;
    private string $jti;

    private int $expire_in;
    private int $expire;

    public function __construct(string $api_url, array $token)
    {
        $this->api_url = $api_url;
        $this->access_token = $token['access_token'] ?? '';
        $this->token_type = $token['token_type'] ?? '';
        $this->scope = $token['scope'] ?? '';
        $this->jti = $token['jti'] ?? '';

        $this->expire_in = $token['expires_in'] ?? 0;
        $this->expire = $this->expire_in ? time() + $this->expire_in - Constants::CONNECTION_TIMEOUT : 0;
    }

    public function getApiUrl(): string
    {
        return $this->api_url;
    }

    public function getAccessToken(): string
    {
        return $this->access_token;
    }

    public function getTokenType(): string
    {
        return $this->token_type;
    }

    public function getScope(): string
    {
        return $this->scope;
    }

    public function getJti(): string
    {
        return $this->jti;
    }

    public function getExpire(): int
    {
        return $this->expire;
    }

    public function isExpired(): bool
    {
        return $this->expire < time();
    }
}
