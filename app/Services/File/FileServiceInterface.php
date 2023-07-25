<?php

namespace App\Services\File;

use Illuminate\Database\Eloquent\Model;

interface FileServiceInterface
{
    public function storeIngredients(string $modelType, string $filePath): void;
}
