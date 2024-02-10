<?php

namespace App\Services\Carrier;

use Illuminate\Support\Facades\Http;

class WootService implements CarrierServiceInterface
{
    public function getAuthToken(): array
    {
        $tokenData = [
            'token'  => null,
            'status' => null,
            'error'  => null,
        ];

        $response = Http::post(sprintf('%s/login', config('woot.base_url')), [
            "email"    => config('woot.email'),
            "password" => config('woot.password'),
            "remember" => 1,
        ]);

        if ($response->successful()) {
            $data               = $response->json();
            $tokenData['token'] = $data['token'];

        } else {
            $tokenData['status'] = $response->status();
            $tokenData['error']  = $response->body();
        }

        return $tokenData;
    }
}
