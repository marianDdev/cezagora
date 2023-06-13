<?php

namespace App\Services\Ingredient;

use App\Models\CompanyIngredient;
use App\Models\Ingredient;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class IngredientService implements IngredientServiceInterface
{
    public function create(array $data): void
    {
        /** @var User $user */
        $user = Auth::user();
        $company = $user->company;

        $ingredient = Ingredient::create(
            [
                'name' => $data['name'],
                'description' => $data['description'],
                'function' => $data['function'],
            ]
        );

        CompanyIngredient::create(
            [
                'company_id' => $company->id,
                'ingredient_id' => $ingredient->id,
                'price' => $data['price'],
                'quantity' => $data['quantity'],
            ]
        );
    }
}
