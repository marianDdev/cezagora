<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Nnjeim\World\Models\City;
use Nnjeim\World\Models\Country;
use Nnjeim\World\Models\State;

class CompaniesSeeder extends Seeder
{
    public function run(): void
    {
        $myCompany = $this->seedMyCompany();
        $this->seedMyUser($myCompany);
        $this->seedCompanies();
        $this->seedAddresses();
    }

    private function seedMyCompany(): Company
    {
        return Company::create(
            [
                'company_category_id' => null,
                'name'                => 'Cezius Link',
                'email'               => 'marian@cezius.tech',
                'phone'               => '0737014770',
                'slug'                => 'Cezius-Link',
            ]
        );
    }

    private function seedMyUser(Company $myCompany): void
    {
        User::create(
            [
                'first_name'        => 'Marian',
                'last_name'         => 'Dumitru',
                'is_admin'          => true,
                'company_id'        => $myCompany->id,
                'email'             => 'marian@cezius.tech',
                'email_verified_at' => now(),
                'password'          => '$2y$10$vCm4/r2zlSyOl6bkylqhsu.mhxP/.3q/NNXMGbZEg5MrMQk96hae6',
                'remember_token'    => Str::random(10),
            ]
        );
    }

    private function seedCompanies(): void
    {
        Company::factory(50)
               ->create();
    }

    private function seedAddresses(): void
    {
        foreach (Company::all() as $company) {
            $country = Country::inRandomOrder()->take(1)->first();
            $cities  = City::where('country_id', $country->id)->get();
            $city    = $cities->count() > 0 ? $cities->random() : null;
            $states  = State::where('country_id', $country->id)->get();
            $state   = $states->count() > 0 ? $states->random() : null;

            Address::create(
                [
                    'company_id' => $company->id,
                    'country'    => $country->name,
                    'city'       => $city ? $city->name : null,
                    'state'      => $state ? $state->name : null,
                ]
            );
        }
    }
}
