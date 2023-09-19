<?php

namespace App\Services\Company;

use App\Models\Company;
use Illuminate\Support\Collection;

interface CompanyServiceInterface
{
    public function create(array $validated): Company;

    public function search(string $keyword): Collection;
}
