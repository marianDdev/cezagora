<?php

namespace Database\Seeders;

use App\Models\CompanyService;
use Illuminate\Database\Seeder;

class CompanyServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CompanyService::factory(50)->create();
    }
}
