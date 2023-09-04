<?php

namespace App\Services\Ingredient;

use App\Events\IngredientsFileProcessed;
use App\Jobs\InsertIngredientsFromFile;
use App\Models\Company;
use App\Models\Ingredient;
use App\Traits\AuthUser;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\LazyCollection;
use Throwable;

class IngredientService implements IngredientServiceInterface
{
    use AuthUser;

    public function filter(array $filters): Collection
    {
        return Ingredient::when(!is_null($filters['company_id']), fn($query) => $query->where('company_id', $filters['company_id']))
                         ->when(!is_null($filters['name']), fn($query) => $query->where('name', 'LIKE', "%{$filters['name']}%"))
                         ->when(!is_null($filters['common_name']), fn($query) => $query->where('common_name', 'LIKE', "%{$filters['common_name']}%"))
                         ->when(!is_null($filters['function']), fn($query) => $query->whereIn('function', $filters['function']))
                         ->when(!is_null($filters['min_price']), fn($query) => $query->where('price', '>=', $filters['min_price']))
                         ->when(!is_null($filters['max_price']), fn($query) => $query->where('price', '<=', $filters['max_price']))
                         ->when(!is_null($filters['min_quantity']), fn($query) => $query->where('quantity', '>=', $filters['min_quantity']))
                         ->when(!is_null($filters['availability']), fn($query) => $query->where('quantity', $filters['availability']))
                         ->when(!is_null($filters['max_available_at']), function ($query) use ($filters) {
                             $maxDate = Carbon::parse($filters['max_available_at'])->toDateString();

                             return $query->whereDate('available_at', '<=', $maxDate);
                         })->get();
    }

    public function getFiltersData(): array
    {
        $all = Ingredient::all();
        $companies = Company::has('ingredients')->get();
        $functions = $all->unique('function')->pluck('function');

        return [
            'allIngredients' => $all,
            'companies' => $companies,
            'functions' => $functions
        ];
    }

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
