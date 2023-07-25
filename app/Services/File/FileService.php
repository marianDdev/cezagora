<?php

namespace App\Services\File;

use App\Models\Ingredient;
use App\Services\Ingredient\IngredientServiceInterface;
use App\Services\Product\ProductServiceInterface;
use Spatie\SimpleExcel\SimpleExcelReader;

class FileService implements FileServiceInterface
{
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

    public function storeIngredients(string $modelType, string $filePath): void
    {
        //call ->chunk on rows because it is a colection and then insert each chunk
        $chunks = SimpleExcelReader::create($filePath)->getRows()->chunk(1000);

        foreach ($chunks as $chunk) {
            Ingredient::insert($chunk->toArray());
        }
    }
}
