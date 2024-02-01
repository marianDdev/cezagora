<?php

namespace App\Services\Search;

use App\Models\Company;

interface SearchServiceInterface
{
    public function globalSearch(string $keyword): array;
    public function create(string $keyword, ?Company $company): void;
}
