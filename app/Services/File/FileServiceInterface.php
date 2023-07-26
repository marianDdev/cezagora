<?php

namespace App\Services\File;

interface FileServiceInterface
{
    public function storeIngredients(string $modelType, string $filePath): void;
}
