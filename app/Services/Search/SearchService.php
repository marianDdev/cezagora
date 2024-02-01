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
        CompanyServiceInterface $companyService,
        IngredientServiceInterface $ingredientService
    ) {
        $this->companyService = $companyService;
        $this->ingredientService = $ingredientService;
    }

    public function globalSearch(string $keyword): array
    {
        $data = [
            'keyword' => $keyword,
        ];

        $companies = $this->companyService->search($keyword);
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
        $existingSearch = Search::where(['keyword' => $keyword])->first();

        if (!is_null($company)) {
            $existingSearch = $existingSearch->where(['company_id' => $company->id])->first();
        }

        if (is_null($existingSearch)) {
            Search::create(['keyword' => $keyword, 'company_id' => $company?->id]);
        } else {
            $existingSearch->update(['count' => $existingSearch->count + 1]);
        }
    }
}
