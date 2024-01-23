<?php

namespace App\Services\Ingredient;

use App\Models\Company;
use App\Models\Document;
use App\Models\Ingredient;
use App\Models\User;
use App\Traits\AuthUser;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class IngredientService implements IngredientServiceInterface
{
    use AuthUser;


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

    public function update(array $validated): void
    {
        $ingredient = Ingredient::find($validated['id']);
        $ingredient->update($validated);

        if (array_key_exists('documents', $validated)) {
            $documentIds = [];
            foreach ($validated['documents'] as $documentName) {
                $document = Document::firstOrCreate(
                    ['name' => $documentName, 'ingredient_id' => $ingredient->id]
                );

                $documentIds[] = $document->id;
            }

            $existingDocumentIds = $ingredient->documents()->pluck('id')->toArray();
            $documentIdsToDelete = array_diff($existingDocumentIds, $documentIds);
            Document::whereIn('id', $documentIdsToDelete)->delete();
        }

        if (array_key_exists('other_document', $validated)) {
            Document::firstOrCreate(
                ['name' => $validated['other_document'], 'ingredient_id' => $ingredient->id]
            );
        }
    }

    private function getAllFromActiveCompaniesQuery()
    {
        return Ingredient::whereHas('company', function ($query) {
            $query->where('is_active', true);
        });
    }
}
