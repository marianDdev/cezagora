<?php

namespace App\Services\Ingredient;

use App\Models\CompanyIngredient;
use Illuminate\Support\LazyCollection;

interface IngredientServiceInterface
{
    public function getCompanyIngredient(int $companyId, int $ingredientId): CompanyIngredient|null;

    public function bulkInsert(LazyCollection $rows): void;
}
