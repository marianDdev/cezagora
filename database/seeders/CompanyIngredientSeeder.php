<?php

namespace Database\Seeders;

use App\Models\CompanyIngredient;
use Illuminate\Database\Seeder;

class CompanyIngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CompanyIngredient::factory(1000)->create();
    }
}
