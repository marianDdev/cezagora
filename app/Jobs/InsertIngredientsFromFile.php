<?php

namespace App\Jobs;

use App\Models\Company;
use App\Models\Ingredient;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class InsertIngredientsFromFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable;

    private array   $data;
    private Company $company;

    private const REQUIRED_KEYS = [
        'name',
        'description',
        'function',
        'price',
        'quantity',
        'availability',
        'available_at',
    ];

    /**
     * Create a new job instance.
     */
    public function __construct(Company $company, array $data)
    {
        $this->data    = $data;
        $this->company = $company;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach ($this->data as $datum) {
            $datum = array_merge($datum, ['company_id' => $this->company->id]);
            $this->validateKeysExist($datum);
            $this->validatValues($datum);
            Ingredient::create($datum);
        }
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
