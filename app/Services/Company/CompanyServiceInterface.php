<?php

namespace App\Services\Company;

use App\Models\Company;

interface CompanyServiceInterface
{
    public function create(array $validated): Company;
}
