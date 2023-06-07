<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Spatie\SimpleExcel\SimpleExcelReader;

class FileService implements FileServiceInterface
{
    public function storeContent(Model $model, string $filePath): void
    {
        $rows = SimpleExcelReader::create($filePath)->getRows();

        $rows->each(function (array $rowProperties) use ($model) {
            $model::create($rowProperties);
        });
    }
}
