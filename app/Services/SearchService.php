<?php

namespace App\Services;

use App\Services\Company\CompanyServiceInterface;
use App\Services\Ingredient\IngredientServiceInterface;
use Illuminate\Support\Collection;

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
        $data = [];
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
}
