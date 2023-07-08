<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\CompanyCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->company;
        $category = CompanyCategory::inRandomOrder()->first();
        $slug = sprintf('%s-%s', Str::slug($name), $category->name);

        return [
            'company_category_id' => $category->id,
            'name' => $name,
            'email' => $this->faker->companyEmail,
            'phone' => $this->faker->phoneNumber,
            'slug' => $slug,
        ];
    }
}
