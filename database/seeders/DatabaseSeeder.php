<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(MerchantCategorySeeder::class);
        $this->call(ServicesCategoriesSeeder::class);
        $this->call(WorldSeeder::class);
        $this->call(CompanyCategoriesSeeder::class);
        $this->call(ProducstCategoriesSeeder::class);
        $this->call(PackagingCategoriesSeeder::class);
        $this->call(SettingsSeeder::class);
    }
}
