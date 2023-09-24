<?php

namespace App\Services\Ingredient;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\LazyCollection;

interface IngredientServiceInterface
{
    public function getAll(): Collection;
    public const IMPORT_FILE_NAME = 'import_file';
    public const IMPORTS          = 'imports';

    public const AVAILABLE_NOW = 'now';
    public const AVAILABLE_ON_DEMAND = 'on_demand';
    public const AVAILABILITY_TYPES = [self::AVAILABLE_NOW, self::AVAILABLE_ON_DEMAND];

    public function filter(array $filters): Collection;

    public function getFiltersData(): array;

    public function bulkInsert(LazyCollection $rows): void;

    public function search(string $keyword): Collection;

    public function deleteAll(User $user): void;
}
