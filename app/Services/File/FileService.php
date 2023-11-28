<?php

namespace App\Services\File;

use App\Services\Ingredient\IngredientServiceInterface;
use App\Services\Product\ProductServiceInterface;
use App\Traits\AuthUser;
use Exception;
use Illuminate\Support\LazyCollection;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\SimpleExcel\SimpleExcelReader;

class FileService implements FileServiceInterface
{
    use AuthUser;

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

    /**
     * @throws Exception
     */
    public function validateFileHeader(Media $file): void
    {
        $filePath = storage_path('app/public/' . $file->id . '/' . $file->file_name);
        $header = SimpleExcelReader::create($filePath)->getHeaders();

        $this->validateKeysExist($header);
    }

    /**
     * @throws Exception
     */
    private function validateKeysExist(array $header): void
    {
        if (!$this->hasNecessaryDetails($header)) {
            throw new Exception(
                sprintf(
                    'Your file should have the recommended columns: %s',
                    implode(' | ', self::INGREDIENTS_REQUIRED_KEYS)
                )
            );
        }
    }

    private function hasNecessaryDetails(array $header): bool
    {
        $headerFlipped = array_flip($header);
        $requiredKeys = array_flip(self::INGREDIENTS_REQUIRED_KEYS);

        return count(array_intersect_key($requiredKeys, $headerFlipped)) === count(self::INGREDIENTS_REQUIRED_KEYS);
    }
}
