<?php

namespace App\Services\Carrier;

use App\Models\Company;
use Illuminate\Support\Facades\Http;

class WootService implements CarrierServiceInterface
{
    protected ?string $bearerToken = null;

    public function getAuthToken(): array
    {
        if ($this->bearerToken) {
            return $tokenData = [
                'token'  => $this->bearerToken,
                'status' => 200,
                'error'  => null,
            ];
        }


        $response = Http::post(sprintf('%s/latest/account/login', config('woot.base_url')), [
            "email"    => config('woot.email'),
            "password" => config('woot.password'),
            "remember" => 1,
        ]);

        if ($response->successful()) {
            $data              = $response->json();
            $this->bearerToken = $data['token'];

            return [
                'token'  => $this->bearerToken,
                'status' => $response->status(),
                'error'  => null,
            ];
        }

        return [
            'token'  => null,
            'status' => $response->status(),
            'error'  => $response->body(),
        ];
    }

    public function getCouriers(): array
    {
        $response = Http::get(sprintf('%s/latest/general/couriers', config('woot.base_url')));

        return $response->json();
    }

    public function getServices(): array
    {
        $response = Http::get(sprintf('%s/latest/general/services', config('woot.base_url')));

        return $response->json();
    }

    public function getSenderAddresses(): array
    {
        $tokenData   = $this->getAuthToken();
        $bearerToken = $tokenData['token'];
        $response    = Http::get(sprintf('%s/latest/addresses/sender?page=1&limit=20', config('woot.base_url')));
        $response    = Http::withHeaders([
                                             'Authorization' => 'Bearer ' . $bearerToken,
                                         ])->get(sprintf('%s/latest/addresses/sender?page=1&limit=20', config('woot.base_url')));

        return $response->json();
    }

    public function getCountries(): array
    {
        $response = Http::get(sprintf('%s/latest/general/countries', config('woot.base_url')));

        return $response->json();
    }

    public function getCountry(int $id): array
    {
        $response = Http::get(sprintf('%s/latest/general/countries/%d', config('woot.base_url'), $id));

        return $response->json();
    }

    public function getCounties(): array
    {
        $response = Http::get(sprintf('%s/latest/general/counties', config('woot.base_url')));

        return $response->json();
    }

    public function getCityByName(string $name)
    {
        $response = Http::get(sprintf('%s/latest/general/cities?name=%s', config('woot.base_url'), $name));

        return $response->json();
    }

    public function getOrderPrices(Company $sender, Company $receiver, int $receiverAddressId, int $weight): array
    {
        $senderAddressId = $this->createAndGetAddressId($sender);
        $senderCountryId = $this->getCountryId($sender->address->country_code);
        $receiverCountryId = $this->getCountryId($receiver->address->country_code);
        $token          = $this->getAuthToken()['token'];

        $payload = [
            "sender"    => [
                "address_id" => $senderAddressId,
                'country_id' => $senderCountryId
            ],
            "receiver"  => [
                "address_id" => $receiverAddressId,
                'country_id' => $receiverCountryId
            ],
            "parcels"   => [
                [
                    "type"    => "package",
                    "length"  => 1,
                    "width"   => 1,
                    "height"  => 1,
                    "weight"  => $weight,
                    "content" => "TEST MARIAN CEZAGORA ingredients",
                ],
            ],
            "repayment" => 0,
            "insurance" => 50,
            "options"   => [
                "opd" => true,
                "sat" => true,
                "rdc" => true,
                "pxc" => true,
            ],
        ];

        $response = Http::withToken($token)->post(sprintf('%s/latest/orders/prices', config('woot.base_url')), $payload);

        return $response->json();
    }

    public function createAndGetAddressId(Company $company): int
    {
        $cityId         = collect($this->getCityByName($company->address->city))->first()['id'];
        $countryId      = $this->getCountryId($company->address->country_code);
        $token          = $this->getAuthToken()['token'];

        $response = Http::withToken($token)->post(sprintf('%s/latest/addresses/sender', config('woot.base_url')), [
            "company"      => 1, //o for individuals and 1 for companies?
            "company_name" => $company->name . 'TEST MARIAN CEZAGORA',
            "contact"      => $company->user->getFullName() . 'TEST MARIAN CEZAGORA',
            "phone"        => $company->phone,
            "email"        => $company->email,
            'country_id'   => $countryId,
            'city_id'      => $cityId,
            'city'         => $company->address->city,
            'address'      => $company->address->city, //todo add full address
            'zipcode'      => '',
            'info'         => '',
        ]);

        return $response->json()['id'];
    }

    private function getCountryId(string $countryCode): int
    {
        $countryCodeMap = collect($this->getCountries())->keyBy('code');

        return $countryCodeMap->get($countryCode)['id'];
    }
}
