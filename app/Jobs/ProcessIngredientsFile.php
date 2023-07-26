<?php

namespace App\Jobs;

use App\Models\Company;
use App\Services\Ingredient\IngredientService;
use App\Services\Ingredient\IngredientServiceInterface;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessIngredientsFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable;

    private array             $data;
    private IngredientService $ingredientService;
    private Company           $company;

    /**
     * Create a new job instance.
     */
    public function __construct(
        Company $company,
        IngredientServiceInterface $ingredientService,
        array $data
    ) {
        $this->data = $data;
        $this->ingredientService = $ingredientService;
        $this->company = $company;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->ingredientService->bulkInsert($this->company, $this->data);
    }
}
