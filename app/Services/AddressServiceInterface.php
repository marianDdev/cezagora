<?php

namespace App\Services;

interface AddressServiceInterface
{
    public function create(array $validated, int $companyId): void;
}
