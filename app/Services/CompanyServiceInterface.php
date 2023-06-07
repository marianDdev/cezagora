<?php

namespace App\Services;

use App\Models\Company;

interface CompanyServiceInterface
{
    public function create(array $validated): Company;
}
