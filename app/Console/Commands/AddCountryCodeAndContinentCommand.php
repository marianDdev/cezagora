<?php

namespace App\Console\Commands;

use App\Models\Address;
use Illuminate\Console\Command;
use Nnjeim\World\Models\Country;

class AddCountryCodeAndContinentCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-country-code-and-continent-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $addresses = Address::all();
        foreach ($addresses as $address) {
            $countyModel = Country::where('name', $address->country)->first();
            $address->update(
                [
                    'country_code' => $countyModel->iso2,
                    'continent'    => $countyModel->region,
                    'region' => $countyModel->subregion
                ]
            );
        }
    }
}
