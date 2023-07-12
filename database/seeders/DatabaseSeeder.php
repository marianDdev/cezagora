<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(ServicesCategoriesSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(WorldSeeder::class);
        $this->call(CompanyCategoriesSeeder::class);
        $this->call(ProducstCategoriesSeeder::class);
        $this->call(CompaniesSeeder::class);
        $this->call(CompanyServiceSeeder::class);
        $this->call(ProductsSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(IngredientsSeeder::class);
        $this->call(CompanyIngredientsSeeder::class);
        $this->call(PackingProductsSeeder::class);
        $this->call(SettingsSeeder::class);
    }
}
