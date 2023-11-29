<?php

namespace App\Services\Ingredient;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\LazyCollection;

interface IngredientServiceInterface
{
    public const AVAILABLE_NOW       = 'now';
    public const AVAILABLE_ON_DEMAND = 'on_demand';
    public const NOT_AVAILABLE       = 'unavailable';
    public const AVAILABILITY_TYPES  = [self::AVAILABLE_NOW, self::AVAILABLE_ON_DEMAND];

    public const REQUIRED_KEYS = [
        'name',
        'common_name',
        'description',
        'function',
        'price',
        'quantity',
        'availability',
        'available_at',
    ];

    public const CHUNK_LIMIT = 1000;

    public function filter(array $filters): Collection;

    public function getFiltersData(): array;

    public function bulkInsert(LazyCollection $rows): void;

    public function search(string $keyword): Collection;

    public function deleteAll(User $user): void;
}
