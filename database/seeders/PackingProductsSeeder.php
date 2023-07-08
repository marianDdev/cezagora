<?php

namespace Database\Seeders;

use App\Models\PackingProduct;
use App\Models\PackingProductCategory;
use Illuminate\Database\Seeder;

class PackingProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (PackingProductCategory::CATEGORIES as $category) {
            PackingProductCategory::create(['name' => $category]);
        }

        PackingProduct::factory(50)->create();
    }
}
