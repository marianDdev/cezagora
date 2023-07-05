<?php

namespace App\Services\Ingredient;

use App\Models\CompanyIngredient;
use App\Models\Ingredient;
use App\Traits\AuthUser;

class IngredientService implements IngredientServiceInterface
{
    use AuthUser;

    public function create(array $data): void
    {
        $company = $this->authUserCompany();

        $ingredient = Ingredient::create(
            [
                'name' => $data['name'],
                'description' => $data['description'],
                'function' => $data['function'],
            ]
        );

        //todo replace dummy values from company id, price and quantity
        CompanyIngredient::create(
            [
                'company_id' => $company->id ?? rand(1,10),
                'ingredient_id' => $ingredient->id,
                'price' => $data['price'] ?? rand(110, 220202),
                'quantity' => $data['quantity'] ?? rand(134, 7202),
            ]
        );
    }
}
