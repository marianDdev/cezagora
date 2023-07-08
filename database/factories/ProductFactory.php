<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\ProductsCategory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_id' => Company::inRandomOrder()->first()->id,
            'product_category_id' => ProductsCategory::inRandomOrder()->first()->id,
            'name' => $this->faker->userName,
            'price' => rand(100, 99999),
            'quantity' => rand(100, 99999),
            'description' => $this->faker->text(20),
            'manufactured_at' => Carbon::now()->subDays(rand(1,4)),
            'expire_at' =>Carbon::now()->addDays(rand(60,365)),
        ];
    }
}
