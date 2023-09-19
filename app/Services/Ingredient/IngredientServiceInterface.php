<?php

namespace App\Services\Ingredient;

use Illuminate\Support\Collection;
use Illuminate\Support\LazyCollection;

interface IngredientServiceInterface
{
    public function filter(array $filters): Collection;

    public function getFiltersData(): array;

    public function bulkInsert(LazyCollection $rows): void;

    public function search(string $keyword): Collection;
}
