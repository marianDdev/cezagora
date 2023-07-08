<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CompanyService>
 */
class CompanyServiceFactory extends Factory
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
            'service_id' => Service::inRandomOrder()->first()->id,
            'price' => rand(100, 99999)
        ];
    }
}
