<?php

namespace App\Services\Ingredient;

use App\Jobs\InsertIngredientsFromFile;
use App\Models\Company;
use App\Models\Ingredient;
use App\Models\User;
use App\Traits\AuthUser;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\LazyCollection;
use Throwable;

class IngredientService implements IngredientServiceInterface
{
    use AuthUser;

    public function getAll(): Collection
    {
        $companies = Company::where('is_active', true)->has('ingredients')->get();
        $companiesIds = $companies->pluck('id');

        return Ingredient::whereIn('company_id', $companiesIds)->get();
    }
    public function filter(array $filters): Collection
    {
        $ingredients = $this->getAll();

        return $ingredients->when(!empty($filters['company_id']), function (Collection $collection) use ($filters) {
            return $collection->where('company_id', $filters['company_id']);
        })
                           ->when(!empty($filters['name']), function (Collection $collection) use ($filters) {
                               return $collection->where('name', 'LIKE', "%{$filters['name']}%");
                           })
                           ->when(!empty($filters['common_name']), function (Collection $collection) use ($filters) {
                               return $collection->where('common_name', 'LIKE', "%{$filters['common_name']}%");
                           })
                           ->when(!empty($filters['functions']), function (Collection $collection) use ($filters) {
                               return $collection->whereIn('function', $filters['functions']);
                           })
                           ->when(!empty($filters['min_price']), function (Collection $collection) use ($filters) {
                               return $collection->where('price', '>=', $filters['min_price']);
                           })
                           ->when(!empty($filters['max_price']), function (Collection $collection) use ($filters) {
                               return $collection->where('price', '<=', $filters['max_price']);
                           })
                           ->when(!empty($filters['availability']), function (Collection $collection) use ($filters) {
                               return $collection->where('availability', $filters['availability']);
                           })
                           ->when(!empty($filters['available_at']), function (Collection $collection) use ($filters) {
                               $maxDate = Carbon::parse($filters['available_at'])->format('Y-m-d');

                               return $collection->where('available_at', '<=', $maxDate);
                           });
    }

    public function getFiltersData(): array
    {
        $companies = Company::where('is_active', true)->has('ingredients')->get();
        $all = $this->getAll();
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
        return Ingredient::where('name','LIKE',"%{$keyword}%")
                      ->orWhere('common_name', 'LIKE',"%{$keyword}%")
                      ->orWhere('function', 'LIKE',"%{$keyword}%")
                      ->get();
    }

    public function deleteAll(User $user): void
    {
        $company = $user->company;
        Ingredient::where('company_id', $company->id)->delete();
    }
}
