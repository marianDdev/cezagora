<?php

namespace Database\Seeders;

use App\Models\ServicesCategory;
use Illuminate\Database\Seeder;

class ServicesCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (ServicesCategory::CATEGORIES as $category) {
            ServicesCategory::create(['name' => $category]);
        }
    }
}
