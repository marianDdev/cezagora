<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use Nnjeim\World\Models\City;
use Nnjeim\World\Models\Country;
use Nnjeim\World\Models\State;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{

    public function definition(): array
    {
        $country = Country::inRandomOrder()->take(1)->first();
        $cities = City::where('country_id', $country->id)->get();
        $city = $cities->count() > 0? $cities->random() : null;
        $states = State::where('country_id', $country->id)->get();
        $state = $states->count() > 0 ? $states->random() : null;

        return [
            'company_id' => Company::inRandomOrder()->take(1)->first()->id,
            'country' => $country->name,
            'city' => $city ? $city->name : null,
            'state' => $state ? $state->name : null,
        ];
    }
}
