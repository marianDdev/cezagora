<?php

namespace App\Services\File;

use App\Jobs\ProcessIngredientsFile;
use App\Services\Ingredient\IngredientServiceInterface;
use App\Services\Product\ProductServiceInterface;
use App\Traits\AuthUser;
use Illuminate\Support\Facades\Bus;
use Spatie\SimpleExcel\SimpleExcelReader;
use Throwable;

class FileService implements FileServiceInterface
{
    use AuthUser;

    private const INGREDIENT = 'ingredient';
    private const PRODUCT    = 'product';

    private IngredientServiceInterface $ingredientService;
    private ProductServiceInterface    $productService;

    public function __construct(
        IngredientServiceInterface $ingredientService,
        ProductServiceInterface    $productService
    )
    {
        $this->ingredientService = $ingredientService;
        $this->productService    = $productService;
    }

    /**
     * @throws Throwable
     */
    public function storeIngredients(string $modelType, string $filePath): void
    {
        $company = $this->authUserCompany();
        $batches = [];
        $chunks  = SimpleExcelReader::create($filePath)->getRows()->chunk(2);

        foreach ($chunks as $chunk) {
            $batches[] = new ProcessIngredientsFile($company, $this->ingredientService, $chunk->toArray());
        }

        Bus::batch($batches)->dispatch();
    }
}
