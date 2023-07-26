<?php

namespace App\Services\Ingredient;

use App\Models\Company;
use App\Models\CompanyIngredient;
use App\Models\Ingredient;
use App\Traits\AuthUser;
use Exception;
use Illuminate\Support\Str;

class IngredientService implements IngredientServiceInterface
{
    use AuthUser;

    private const REQUIRED_KEYS = [
        'name',
        'description',
        'function',
        'price',
        'quantity',
    ];

    /**
     * @throws Exception
     */
    public function bulkInsert(Company $company, array $data): void
    {
        $ingredients = [];

        foreach ($data as $datum) {
            $this->validateKeysExist($datum);
            $this->validatValues($datum);
            $ingredient = Ingredient::create(
                [
                    'name'        => $datum['name'],
                    'description' => $datum['description'],
                    'function'    => $datum['function'],
                ]
            );
            $slug       = Str::slug(substr($ingredient->name, 0, 20));
            $ingredient->update(['slug' => sprintf('%s-%d', $slug, $ingredient->id)]);

            $ingredients[] = [
                'ingredient_id' => $ingredient->id,
                'price'         => $datum['price'],
                'quantity'      => $datum['quantity'],
                'company_id'    => $company->id,
            ];
        }

        CompanyIngredient::insert($ingredients);
    }

    /**
     * @throws Exception
     */
    private function validateKeysExist(array $ingredient): void
    {
        if (!$this->hasNecessaryDetails($ingredient)) {
            throw new Exception(
                sprintf(
                    'Please make sure that your list of ingredients contain all the necessary colums: %s',
                    implode(',', self::REQUIRED_KEYS)
                )
            );
        }
    }

    /**
     * @throws Exception
     */
    private function validatValues(array $ingredient): void
    {
        foreach ($ingredient as $key => $value) {
            if (is_null($value)) {
                throw new Exception(
                    sprintf(
                        'Please make sure that the value for %s is not empty',
                        $key
                    )
                );
            }
        }
    }

    private function hasNecessaryDetails(array $ingredient): bool
    {
        return count(array_intersect_key(array_flip(self::REQUIRED_KEYS), $ingredient)) === count(self::REQUIRED_KEYS);
    }
}
