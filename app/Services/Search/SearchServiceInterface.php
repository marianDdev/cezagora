<?php

namespace App\Services\Search;

use App\Models\Company;
use Illuminate\Support\Collection;

interface SearchServiceInterface
{
    public function globalSearch(string $keyword): array;
    public function create(string $keyword, ?Company $company): void;
    public function searchCompanies(string $keyword): Collection;
    public function searchIngredients(string $keyword): Collection;
}
