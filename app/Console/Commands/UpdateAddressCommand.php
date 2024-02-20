<?php

namespace App\Console\Commands;

use App\Models\Address;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class UpdateAddressCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:address';

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
        foreach (Address::all() as $address) {
            if (!$address->street) {
                $street = sprintf('Street %s no %d', ucfirst(Str::random(rand(5, 16))), rand(1,999));
                $address->street = $street;

                $this->output->writeln(sprintf('Added street: %s', $street));
            }

            if (!$address->zipcode) {
                $zipcode = \Faker\Provider\Address::postcode();
                $address->zipcode = $zipcode;
                $this->output->writeln(sprintf('Added zipcode: %s', $zipcode));
            }

            $address->save();
        }
    }
}
