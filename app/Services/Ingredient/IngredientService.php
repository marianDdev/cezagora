<?php

namespace App\Services\Ingredient;

use App\Models\CompanyIngredient;
use App\Models\Ingredient;
use App\Traits\AuthUser;
use Illuminate\Support\Str;

class IngredientService implements IngredientServiceInterface
{
    use AuthUser;

    public function create(array $data): void
    {
        $company = $this->authUserCompany();
        $slug = Str::slug(substr($data['name'], 0, 20));

        $ingredient = Ingredient::create(
            [
                'name' => $data['name'],
                'description' => $data['description'],
                'function' => $data['function'],
            ]
        );

        $ingredient->update(['slug' => sprintf('%s-%d', $slug, $ingredient->id)]);

        //todo replace dummy values from companies id, price and quantity
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
