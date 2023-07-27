<?php

namespace App\Services\File;

interface FileServiceInterface
{
    public function storeIngredients(string $filePath): void;
}
