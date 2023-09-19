<?php

namespace App\Services;

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
        $companies = $this->companyService->search($keyword);

        return ['companies' => $companies];
    }
}
