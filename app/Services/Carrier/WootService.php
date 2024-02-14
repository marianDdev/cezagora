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

        $response = Http::post(sprintf('%s/latest/account/login', config('woot.base_url')), [
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

    public function  getCouriers(): array
    {
        $response = Http::get(sprintf('%s/latest/general/couriers', config('woot.base_url')));

        return $response->json();
    }

    public function  getServices(): array
    {
        $response = Http::get(sprintf('%s/latest/general/services', config('woot.base_url')));

        return $response->json();
    }

    public function  getSenderAddresses(): array
    {
        $tokenData = $this->getAuthToken();
        $bearerToken = $tokenData['token'];
        $response = Http::get(sprintf('%s/latest/addresses/sender?page=1&limit=20', config('woot.base_url')));
        $response = Http::withHeaders([
                                          'Authorization' => 'Bearer ' . $bearerToken,
                                      ])->get(sprintf('%s/latest/addresses/sender?page=1&limit=20', config('woot.base_url')));

        return $response->json();
    }

    public function getCountries(): array
    {
        $response = Http::get(sprintf('%s/latest/general/countries', config('woot.base_url')));

        return $response->json();
    }

    public function getCounties(): array
    {
        $response = Http::get(sprintf('%s/latest/general/counties', config('woot.base_url')));

        return $response->json();
    }
}
