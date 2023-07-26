<?php

namespace App\Services\Ingredient;

use App\Models\Company;

interface IngredientServiceInterface
{
    public function bulkInsert(Company $company, array $data): void;
}
