<?php

namespace App\Services\File;

use Illuminate\Support\LazyCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

interface FileServiceInterface
{
    public const CHUNK_LIMIT = 500;
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

    public const PACKAGING_REQUIRED_KEYS = [
        'category',
        'name',
        'description',
        'price',
        'capacity',
        'colour',
        'material',
        'neck_size',
        'bottom_shape',
    ];

    public const INGREDIENT = 'ingredient';
    public const PRODUCT    = 'product';
    public const PACKAGING    = 'packaging';

    public function upload(string $entityName): void;
}
