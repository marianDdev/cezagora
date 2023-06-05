<?php

namespace Database\Seeders;

use App\Models\ProductsCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProducstCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (ProductsCategory::CATEGORIES as $category) {
            ProductsCategory::create(['name' => $category]);
        }
    }
}
