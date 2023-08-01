<?php

namespace App\Services\Ingredient;

use App\Events\IngredientsFileProcessed;
use App\Jobs\InsertIngredientsFromFile;
use App\Notifications\WelcomeEmail;
use App\Traits\AuthUser;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\LazyCollection;
use Throwable;

class IngredientService implements IngredientServiceInterface
{
    use AuthUser;

    /**
     * @throws Throwable
     */
    public function bulkInsert(LazyCollection $rows): void
    {
        $company = $this->authUserCompany();
        $chunks  = $rows->chunk(1000);
        $batch   = Bus::batch([])
                      ->name('Insert ingredients from file')
                      ->dispatch();

        foreach ($chunks as $chunk) {
            $batch->add(new InsertIngredientsFromFile($company, $chunk->toArray()));
        }
    }
}
