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

    public const VARIANT_UNIT_GR = 'gr';
    public const VARIANT_UNIT_ML = 'ml';
    public const VARIANT_UNIT_KG = 'kg';
    public const VARIANT_UNIT_L = 'l';
    public const VARIANT_UNITS = [self::VARIANT_UNIT_GR, self::VARIANT_UNIT_ML, self::VARIANT_UNIT_KG, self::VARIANT_UNIT_L];
    public const VARIANT_UNITS_MACRO = [self::VARIANT_UNIT_KG, self::VARIANT_UNIT_L];

    public function filter(array $filters): Collection;

    public function getFiltersData(): array;

    public function search(string $keyword): Collection;

    public function deleteAll(User $user): void;
}
