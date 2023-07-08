<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\PackingProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PackingProduct>
 */
class PackingProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->userName;
        $category = PackingProductCategory::inRandomOrder()->first();
        return [
            'company_id' => Company::inRandomOrder()->first()->id,
            'packing_product_category_id' => $category->id,
            'name' => $this->faker->userName,
            'description' => $this->faker->text(20),
            'slug' => sprintf('%s-%s', Str::slug($name), $category->name),
            'price' => rand(100, 999),
            'capacity' => rand(15, 1000),
            'colour' => $this->faker->randomElement(['black', 'white', 'red', 'blue', 'green', 'yellow', 'orange', 'indigo']),
            'material' => $this->faker->randomElement(['aluminium', 'acrylic', 'glass', 'ABS']),
            'neck_size' => $this->faker->randomElement(['100/400', '18/415', '20/410', '24/410', '43/400', '70/400', '89/400']),
            'bottom_shape' => $this->faker->randomElement(['oval', 'rectangle', 'round', 'square']),
        ];
    }
}
