<?php

namespace App\Services\Address;

interface AddressServiceInterface
{
    public function create(array $validated, int $companyId): void;
}
