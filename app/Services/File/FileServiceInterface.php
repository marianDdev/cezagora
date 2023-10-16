<?php

namespace App\Services\File;

use Illuminate\Support\LazyCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

interface FileServiceInterface
{
    public const REQUIRED_KEYS = [
        'name',
        'common_name',
        'description',
        'function',
        'price',
        'quantity',
        'availability',
        'available_at',
    ];

    public const INGREDIENT = 'ingredient';
    public const PRODUCT    = 'product';

    public function addToMediaCollection(string $fileName, string $collectionName): Media;

    public function extractRows(Media $file): LazyCollection;

    public function validateFileHeader(Media $file): void;
}
