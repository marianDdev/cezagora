<?php

namespace App\Jobs;

use App\Models\Company;
use App\Models\Packaging;
use App\Models\PackagingCategory;
use Exception;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class InsertPackagingFromFileJob implements ShouldQueue
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
            $category = PackagingCategory::where('name', $datum['category'])->first();

            if (is_null($category)) {
                throw new Exception(
                    __('messages.invalid_category', ['category' => $datum['category']])
                );
            }

            $categoryId = $category->id;
            $datum      = array_merge(
                $datum,
                [
                    'company_id' => $this->company->id,
                    'packaging_category_id' => $categoryId,
                ]
            );

            $this->validateValues($datum);

            Packaging::create($datum);
        }
    }

    /**
     * @throws Exception
     */
    private function validateValues(array $packaging): void
    {
        foreach ($packaging as $key => $value) {
            if (is_null($value)) {
                throw new Exception(
                    __('messages.make_sure_value_not_empty', ['key' => $key])
                );
            }
        }
    }
}
