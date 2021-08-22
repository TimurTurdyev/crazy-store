<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Main\Cdek\Client;
use App\Main\Cdek\Oauth;
use Illuminate\Http\Request;

class CdekController extends Controller
{
    public function index($method, Request $request): \Illuminate\Http\JsonResponse
    {
        $client = new Client((new Oauth())->authorize());

        if (!method_exists($client, $method)) {
            return response()->json(['method not exist'], 500);
        }

        $response = $client->{$method}($request->all());

        if ($response->failed()) {
            return response()->json($response->json(), $response->status());
        }

        return response()->json($response->json());
    }
}
