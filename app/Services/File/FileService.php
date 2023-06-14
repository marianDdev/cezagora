<?php

namespace App\Services\File;

use App\Services\Ingredient\IngredientServiceInterface;
use App\Services\Product\ProductServiceInterface;
use Illuminate\Support\Facades\Storage;
use Spatie\SimpleExcel\SimpleExcelReader;

class FileService implements FileServiceInterface
{
    private  const INGREDIENT = 'ingredient';
    private  const PRODUCT = 'product';

    private IngredientServiceInterface $ingredientService;
    private ProductServiceInterface    $productService;

    public function __construct(
        IngredientServiceInterface $ingredientService,
        ProductServiceInterface $productService
    ) {
        $this->ingredientService = $ingredientService;
        $this->productService = $productService;
    }

    public function storeContent(string $modelType, string $filePath): void
    {
        $rows = SimpleExcelReader::create($filePath)->getRows();

        $rows->each(function (array $rowProperties) use ($modelType, $filePath) {
            switch ($modelType) {
                case self::INGREDIENT:
                    $this->ingredientService->create($rowProperties);

                    if (Storage::exists($filePath)) {
                        Storage::delete($filePath);
                    }
                    break;
                case self::PRODUCT:
                    $this->productService->create($rowProperties);

            }
        });
    }
}
