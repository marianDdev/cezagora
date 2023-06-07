<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(WorldSeeder::class);
        $this->call(CompanyCategorySeeder::class);
        $this->call(ProducstCategoriesSeeder::class);
        $this->call(CompanySeeder::class);
        User::factory(50)->create();
        Address::factory(50)->create();
        $this->call(IngredientsSeeder::class);
    }
}
