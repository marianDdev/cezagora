<?php

namespace App\Console\Commands;

use App\Models\Company;
use App\Models\CompanyIngredient;
use App\Models\Ingredient;
use Illuminate\Console\Command;

class UpdateAllIngredientsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-all-ingredients-command';

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
       $companies = Company::all();

       foreach ($companies as $company) {
            $company->ingredients()
                ->updateExistingPivot(
                    $company->id,
                    ['price' => rand(100, 1000), 'quantity' => rand(1, 100)]
                );
       }
    }
}
