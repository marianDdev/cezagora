<?php

namespace Database\Factories;

use App\Models\ServicesCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'services_category_id' => ServicesCategory::inRandomOrder()->first()->id,
            'name' => $this->faker->userName,
            'description' => $this->faker->text(20)
        ];
    }
}
