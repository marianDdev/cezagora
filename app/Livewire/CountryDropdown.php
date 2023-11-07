<?php

namespace App\Livewire;

use Livewire\Component;
use Nnjeim\World\Models\City;
use Nnjeim\World\Models\Country;
use Nnjeim\World\Models\State;

class CountryDropdown extends Component
{
    public $countries;
    public $states;
    public $cities;

    public $selectedCountry = null;
    public $selectedState = null;
    public $selectedCity = null;

    public function mount(): void
    {
        $this->countries = Country::where('region', 'Europe')->get();

        $address = auth()->user()->company->address ?? null;
        if ($address) {
            $this->selectedCountry = $address->country;
            $this->states = State::whereHas('country', function ($query) use ($address) {
                $query->where('name', $address->country);
            })->get();

            $this->selectedState = $address->state;
            $this->cities = City::whereHas('state', function ($query) use ($address) {
                $query->where('name', $address->state);
            })->get();

            $this->selectedCity = $address->city;
        }
    }

    public function render()
    {
        return view('livewire.country-dropdown');
    }

    public function updatedSelectedCountry($country)
    {
        $this->states = State::whereHas('country', function ($query) use ($country) {
            $query->where('name', $country);
        })->get();
        $this->selectedState = null;
        $this->cities = collect();
        $this->selectedCity = null;
    }

    public function updatedSelectedState($state)
    {
        $this->cities = City::whereHas('state', function ($query) use ($state) {
            $query->where('name', $state);
        })->get();
        $this->selectedCity = null;
    }
}
