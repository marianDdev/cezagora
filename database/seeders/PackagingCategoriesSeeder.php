<?php

namespace Database\Seeders;

use App\Models\Packaging;
use App\Models\PackagingCategory;
use Illuminate\Database\Seeder;

class PackagingCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->getCategories() as $category) {
            PackagingCategory::create(['name' => $category]);
        }
    }

    private function getCategories(): array
    {
        return [
            'bottle',
            'jar',
            'roll-on',
            'airless packaging',
            'tube',
            'spray',
            'caps closure',
            'dosing pump',
            'trigger',
            'dispenser',
            'aerosol can',
            'compacts',
            'stick',
            'dropper',
            'sachet,',
            'pouch',
            'vial',
            'blister Pack',
        ];
    }
}
