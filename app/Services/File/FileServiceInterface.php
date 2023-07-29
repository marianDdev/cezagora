<?php

namespace App\Services\File;

use Illuminate\Support\LazyCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

interface FileServiceInterface
{
    public function addToMediaCollection(string $fileName, string $collectionName): Media;

    public function extractRows(Media $file): LazyCollection;
}
