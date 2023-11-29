<?php

namespace App\Services\File;

use Illuminate\Support\LazyCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

interface FileServiceInterface
{
    public const IMPORT_FILE_NAME = 'import_file';
    public const IMPORTS          = 'imports';
    public const MODELS = [
        'ingredient',
        'packaging',
        'product',
    ];

    public const INGREDIENTS_REQUIRED_KEYS = [
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

    public function upload(string $entityName): void;
}
