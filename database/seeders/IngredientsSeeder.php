<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use App\Services\File\FileServiceInterface;
use Illuminate\Database\Seeder;

class IngredientsSeeder extends Seeder
{
    private FileServiceInterface $fileService;

    public function __construct(FileServiceInterface $fileService)
    {
        $this->fileService = $fileService;
    }

    public function run(): void
    {
        $this->fileService->storeContent('ingredient', public_path('ingredients_2.csv'));
    }
}
