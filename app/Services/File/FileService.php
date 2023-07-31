<?php

namespace App\Services\File;

use App\Services\Ingredient\IngredientServiceInterface;
use App\Services\Product\ProductServiceInterface;
use App\Traits\AuthUser;
use Illuminate\Support\LazyCollection;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\SimpleExcel\SimpleExcelReader;

class FileService implements FileServiceInterface
{
    use AuthUser;

    private const INGREDIENT = 'ingredient';
    private const PRODUCT    = 'product';

    private const CHUNK_LIMIT = 1000;

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
     * @throws FileIsTooBig
     * @throws FileDoesNotExist
     */
    public function addToMediaCollection(string $fileName, string $collectionName): Media
    {
        $user = $this->authUser();

        return $user->addMediaFromRequest($fileName)
                    ->toMediaCollection($collectionName);
    }

    public function extractRows(Media $file): LazyCollection
    {
        $filePath = storage_path('app/public/' . $file->id . '/' . $file->file_name);

        return SimpleExcelReader::create($filePath)->getRows();
    }
}
