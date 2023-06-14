<?php

namespace App\Services\File;

use Illuminate\Database\Eloquent\Model;

interface FileServiceInterface
{
    public function storeContent(string $modelType, string $filePath): void;
}
