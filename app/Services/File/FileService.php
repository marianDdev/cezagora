<?php

namespace App\Services\File;

use App\Jobs\InsertIngredientsFromFileJob;
use App\Jobs\InsertPackagingFromFileJob;
use App\Services\Ingredient\IngredientServiceInterface;
use App\Services\Product\ProductServiceInterface;
use App\Traits\AuthUser;
use Exception;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\LazyCollection;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\SimpleExcel\SimpleExcelReader;
use Throwable;

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
     * @throws Throwable
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function upload(string $entityName): void
    {
        $file = $this->addToMediaCollection($entityName, sprintf('%ss', $entityName));
        $this->validateFileHeader($file, $entityName);
        $fileRows = $this->extractRows($file);
        $this->bulkInsert($fileRows, $entityName);
    }

    /**
     * @throws Throwable
     */
    private function bulkInsert(LazyCollection $rows, string $entityName): void
    {
        $company = $this->authUserCompany();
        $chunks  = $rows->chunk(self::CHUNK_LIMIT);
        $batch   = Bus::batch([])
                      ->name(sprintf('Insert %ss from file', $entityName))
                      ->dispatch();

        switch ($entityName) {
            case self::INGREDIENT:
                foreach ($chunks as $chunk) {
                    $batch->add(new InsertIngredientsFromFileJob($company, $chunk->toArray()));
                }
                break;

            case self::PACKAGING:
                foreach ($chunks as $chunk) {
                    $batch->add(new InsertPackagingFromFileJob($company, $chunk->toArray()));
                }
                break;
        }
    }

    /**
     * @throws FileIsTooBig
     * @throws FileDoesNotExist
     */
    private function addToMediaCollection(string $fileName, string $collectionName): Media
    {
        $user = $this->authUser();

        return $user->addMediaFromRequest($fileName)
                    ->toMediaCollection($collectionName);
    }

    private function extractRows(Media $file): LazyCollection
    {
        $path     = sprintf('app/public/%d/%s', $file->id, $file->file_name);
        $filePath = storage_path($path);

        return SimpleExcelReader::create($filePath)->getRows();
    }

    /**
     * @throws Exception
     */
    private function validateFileHeader(Media $file, string $entityName): void
    {
        $path     = sprintf('app/public/%d/%s', $file->id, $file->file_name);
        $filePath = storage_path($path);
        $header   = SimpleExcelReader::create($filePath)->getHeaders();

        $this->validateKeysExist($header, $entityName);
    }

    /**
     * @throws Exception
     */
    private function validateKeysExist(array $header, string $entityName): void
    {
        if (!$this->hasNecessaryDetails($header, $entityName)) {
            throw new Exception(__('messages.no_required_columns'));
        }
    }

    private function hasNecessaryDetails(array $header, string $entityName): bool
    {
        $headerFlipped = array_flip($header);

        switch ($entityName) {
            case self::INGREDIENT:
                $requiredKeys = array_flip(self::INGREDIENTS_REQUIRED_KEYS);

                return count(array_intersect_key($requiredKeys, $headerFlipped)) === count(self::INGREDIENTS_REQUIRED_KEYS);
            case self::PACKAGING:
                $requiredKeys = array_flip(self::PACKAGING_REQUIRED_KEYS);

                return count(array_intersect_key($requiredKeys, $headerFlipped)) === count(self::PACKAGING_REQUIRED_KEYS);
        }

        return false;
    }
}
