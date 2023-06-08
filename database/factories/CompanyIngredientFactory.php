<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\CompanyCategory;
use App\Models\CompanyIngredient;
use App\Models\Ingredient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CompanyIngredient>
 */
class CompanyIngredientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $ingredientsSupplyer = CompanyCategory::where('name', CompanyCategory::INGREDIENTS_SUPPLIER)->first();
        return [
            'company_id' => Company::where('company_category_id', $ingredientsSupplyer->id)->inRandomOrder()->take(1)->first()->id,
            'ingredient_id' => Ingredient::inRandomOrder()->take(1)->first()->id,
            'price' => rand(10, 370),
            'quantity' => rand(2000, 7800),
        ];
    }
}
