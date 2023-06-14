<?php

namespace App\Services\Address;

use App\Models\Address;

class AddressService implements AddressServiceInterface
{
    public function create(array $validated, int $companyId): void
    {
        Address::create(
            [
                'company_id' => $companyId,
                'country' => $validated['country'],
                'state' => $validated['state'],
                'city' => $validated['city'],
            ]
        );
    }
}
