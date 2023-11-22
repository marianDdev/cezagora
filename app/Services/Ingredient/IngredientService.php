<?php

namespace App\Services\Ingredient;

use App\Jobs\InsertIngredientsFromFile;
use App\Models\Company;
use App\Models\Ingredient;
use App\Models\User;
use App\Traits\AuthUser;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\LazyCollection;
use Throwable;

class IngredientService implements IngredientServiceInterface
{
    use AuthUser;

    public function getAllFromActiveCompaniesQuery()
    {
        return Ingredient::whereHas('company', function ($query) {
            $query->where('is_active', true);
        });
    }

    public function filter(array $filters): Collection
    {
        $ingredients = $this->getAllFromActiveCompaniesQuery();

        return $ingredients->when(!empty($filters['company_id']), function (Builder $query) use ($filters) {
            return $query->where('company_id', $filters['company_id']);
        })
                           ->when(!empty($filters['name']), function (Builder $query) use ($filters) {
                               $name = addcslashes($filters['name'], '%_');

                               return $query->where('name', 'LIKE', "%$name%");
                           })
                           ->when(!empty($filters['common_name']), function (Builder $query) use ($filters) {
                               $commonName = addcslashes($filters['common_name'], '%_');

                               return $query->where('common_name', 'LIKE', "%$commonName%");
                           })
                           ->when(!empty($filters['functions']), function (Builder $query) use ($filters) {
                               return $query->whereIn('function', $filters['functions']);
                           })
                           ->when(!empty($filters['min_price']), function (Builder $query) use ($filters) {
                               $minPrice = $filters['min_price'] * 100;
                               return $query->where('price', '>=', $minPrice);
                           })
                           ->when(!empty($filters['max_price']), function (Builder $query) use ($filters) {
                               $maxPrice = $filters['max_price'] * 100;
                               return $query->where('price', '<=', $maxPrice);
                           })
                           ->when(!empty($filters['availability']), function (Builder $query) use ($filters) {
                               return $query->where('availability', $filters['availability']);
                           })
                           ->when(!empty($filters['available_at']), function (Builder $query) use ($filters) {
                               $maxDate = Carbon::parse($filters['available_at'])->format('Y-m-d');

                               return $query->where('available_at', '<=', $maxDate);
                           })
                           ->get();
    }

    public function getFiltersData(): array
    {
        $companies = Company::where('is_active', true)->has('ingredients')->get();
        $all       = $this->getAllFromActiveCompaniesQuery()->get();
        $functions = $all->unique('function')->pluck('function');

        return [
            'allIngredients' => $all,
            'companies'      => $companies,
            'functions'      => $functions,
        ];
    }

    /**
     * @throws Throwable
     */
    public function bulkInsert(LazyCollection $rows): void
    {
        $company = $this->authUserCompany();
        $chunks  = $rows->chunk(self::CHUNK_LIMIT);
        $batch   = Bus::batch([])
                      ->name('Insert ingredients from file')
                      ->dispatch();

        foreach ($chunks as $chunk) {
            $batch->add(new InsertIngredientsFromFile($company, $chunk->toArray()));
        }
    }

    public function search(string $keyword): Collection
    {
        return Ingredient::where('name', 'LIKE', "%{$keyword}%")
                         ->orWhere('common_name', 'LIKE', "%{$keyword}%")
                         ->orWhere('function', 'LIKE', "%{$keyword}%")
                         ->get();
    }

    public function deleteAll(User $user): void
    {
        $company = $user->company;
        Ingredient::where('company_id', $company->id)->delete();
    }
}
