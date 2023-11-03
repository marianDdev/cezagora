<?php

namespace App\Livewire;

use App\Services\Company\CompanyServiceInterface;
use App\Traits\AuthUser;
use Livewire\Component;
use Nnjeim\World\Models\City;
use Nnjeim\World\Models\Country;
use Nnjeim\World\Models\State;

class CountryDropdown extends Component
{
    use AuthUser;

    public $countries;
    public $states;
    public $cities;

    public $selectedCountry = null;
    public $selectedState   = null;
    public $selectedCity    = null;

    public $existingCountry = null;
    public $existingState   = null;
    public $existingCity    = null;
    private CompanyServiceInterface $companyService;

    public function mount(CompanyServiceInterface $companyService, $selectedCity = null, ): void
    {
        $this->countries    = Country::where('region', 'Europe')->get();
        $this->states       = collect();
        $this->cities       = collect();
        $this->selectedCity = $selectedCity;

        $address = $this->authUserCompany()->address;
        $this->existingCountry = Country::where('iso2', $address->country_code)->first();
        $this->existingState = State::where('country_code', $address->country_code)->first();
        $this->existingCity = City::where('country_code', $address->country_code)->first();

        if (!is_null($selectedCity)) {
            $city = City::with('state.country')->find($selectedCity);
            if ($city) {
                $this->cities          = City::where('state_id', $city->state_id)->get();
                $this->states          = State::where('country_id', $city->state->country_id)->get();
                $this->selectedCountry = $city->state->country_id;
                $this->selectedState   = $city->state_id;
            }
        }
    }

    public function render()
    {
        return view('livewire.country-dropdown');
    }

    public function updatedSelectedCountry($country)
    {
        $countryId = Country::where('name', $country)->first()->id;
        $this->states        = State::where('country_id', $countryId)->get();
        $this->selectedState = null;
    }

    public function updatedSelectedState($state)
    {
        $stateId = State::where('name', $state)->first()->id;
        if (!is_null($state)) {
            $this->cities = City::where('state_id', $stateId)->get();
        }
    }
}
