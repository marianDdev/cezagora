<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

interface FileServiceInterface
{
    public function storeContent(Model $model, string $filePath): void;
}
