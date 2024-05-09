<?php

namespace App\Services\Search;

use App\Models\Company;
use App\Models\Ingredient;
use App\Models\Search;
use Illuminate\Support\Collection;

class SearchService implements SearchServiceInterface
{
    public function globalSearch(string $keyword): array
    {
        $data = [
            'keyword' => $keyword,
        ];

        $companies   = $this->searchCompanies($keyword);
        $ingredients = $this->searchIngredients($keyword);

        if ($companies->count() > 0) {
            $data['companies'] = $companies;
        }

        if ($ingredients->count() > 0) {
            $data['ingredients'] = $ingredients;
        }

        return $data;
    }

    public function create(string $keyword, ?Company $company): void
    {
        $conditions               = ['keyword' => $keyword];
        $conditions['company_id'] = $company?->id;

        $existingSearch = Search::where($conditions)->first();

        if ($existingSearch) {
            $existingSearch->increment('count');
        } else {
            Search::create(
                [
                    'keyword'    => $keyword,
                    'company_id' => $company?->id,
                ]
            );
        }
    }

    public function searchCompanies(string $keyword): Collection
    {
        return Company::search($keyword)->get();
    }

    public function searchIngredients(string $keyword): Collection
    {
        return Ingredient::search($keyword)->get();
    }
}
