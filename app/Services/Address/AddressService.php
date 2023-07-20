<?php

namespace App\Services\Address;

use App\Models\Address;
use Nnjeim\World\Models\Country;

class AddressService implements AddressServiceInterface
{
    public function create(array $validated, int $companyId): void
    {
        $country = Country::where('name', $validated['country'])->first();

        Address::create(
            [
                'company_id' => $companyId,
                'country' => $validated['country'],
                'country_code' => $country->iso2,
                'state' => $validated['state'],
                'city' => $validated['city'],
                'continent' => $country->region,
                'region' => $country->subregion ?? null,
            ]
        );
    }
}
