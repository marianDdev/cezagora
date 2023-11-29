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

class InsertIngredientsFromFileJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable;

    public function __construct(private readonly Company $company, private readonly array $data)
    {
    }

    /**
     * @throws Exception
     */
    public function handle(): void
    {
        foreach ($this->data as $datum) {
            $datum                 = array_merge($datum, ['company_id' => $this->company->id]);
            $availableAt           = $datum['available_at'];
            $date                  = Carbon::parse($availableAt)->format('Y-m-d h:i:s');
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
                    __('messages.make_sure_value_not_empty', ['key' => $key])
                );
            }
        }
    }
}
