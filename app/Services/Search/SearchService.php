<?php

namespace App\Services\Search;

use App\Models\Company;
use App\Models\Search;
use App\Services\Company\CompanyServiceInterface;
use App\Services\Ingredient\IngredientServiceInterface;

class SearchService implements SearchServiceInterface
{
    private CompanyServiceInterface    $companyService;
    private IngredientServiceInterface $ingredientService;

    public function __construct(
        CompanyServiceInterface    $companyService,
        IngredientServiceInterface $ingredientService
    )
    {
        $this->companyService    = $companyService;
        $this->ingredientService = $ingredientService;
    }

    public function globalSearch(string $keyword): array
    {
        $data = [
            'keyword' => $keyword,
        ];

        $companies   = $this->companyService->search($keyword);
        $ingredients = $this->ingredientService->search($keyword);

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
}
