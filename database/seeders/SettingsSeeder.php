<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create(
            [
                'name' => Setting::TRANSACTION_FEE_PERCENTAGE,
                'value' => env('TRANSFER_FEE_PERCENTAGE'),
            ],
            [
                'name' => Setting::DEFAULT_CURRENCY_NAME,
                'value' => Setting::DEFAULT_CURRENCY_VALUE
            ]
        );
    }
}
