<?php

namespace App\Jobs;

use App\Models\Company;
use App\Models\Ingredient;
use Carbon\Carbon;
use Exception;
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
     *
     * @throws Exception
     */
    public function handle(): void
    {
        foreach ($this->data as $datum) {
            $datum = array_merge($datum, ['company_id' => $this->company->id]);
            $availableAt = $datum['available_at'];
            $date = Carbon::parse($availableAt)->format('Y-m-d h:i:s');
            $datum['available_at'] = $date;

            $this->validateValues($datum);

            Ingredient::create($datum);
        }
    }

    /**
     * @throws Exception
     */
    private function validateValues(array $ingredient): void
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
}
