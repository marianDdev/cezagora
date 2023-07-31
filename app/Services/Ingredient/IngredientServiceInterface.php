<?php

namespace App\Services\Ingredient;

use Illuminate\Support\LazyCollection;

interface IngredientServiceInterface
{
    public function bulkInsert(LazyCollection $rows): void;
}
