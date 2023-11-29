<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterIngredientsRequest;
use App\Http\Requests\SearchRequest;
use App\Http\Requests\StoreIngredientRequest;
use App\Http\Requests\UpdateIngredientRequest;
use App\Models\Ingredient;
use App\Services\File\FileServiceInterface;
use App\Services\Ingredient\IngredientServiceInterface;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Throwable;

class IngredientController extends Controller
{
    public function index(FilterIngredientsRequest $request, IngredientServiceInterface $service): View
    {
        $validated   = $request->validated();
        $filtersData = $service->getFiltersData();
        $filtered    = $service->filter($validated);

        return view('ingredients.index', [
            'authCompany'         => $this->authUserCompany(),
            'allIngredients'      => $filtersData['allIngredients'],
            'companies'           => $filtersData['companies'],
            'functions'           => $filtersData['functions'],
            'filteredIngredients' => $filtered,
        ]);
    }

    public function listMyIngredients(): View
    {
        $authCompany = $this->authUserCompany();
        $ingredients = $authCompany->ingredients()->orderByDesc('created_at')->paginate(12);

        return view(
            'ingredients.my_ingredients',
            [
                'ingredients' => $ingredients,
            ]
        );
    }

    public function create(): View
    {
        return view('ingredients.forms.create');
    }

    public function store(StoreIngredientRequest $request): RedirectResponse
    {
        $validated  = $request->validated();
        $ingredient = Ingredient::create($validated);

        if (!$ingredient instanceof Ingredient) {
            return redirect()->route('ingredient.create')
                             ->with(['error_message' => 'Something went wrong']);
        }

        return redirect()->route('my-ingredients')
                         ->with(['successful_message' => 'Ingredient added successfully!']);
    }

    /**
     * @throws Throwable
     */
    public function insertIngredientsFromFile(
        FileServiceInterface       $fileService,
        IngredientServiceInterface $ingredientService
    ): View|RedirectResponse
    {
        try {
            $file = $fileService->addToMediaCollection(IngredientServiceInterface::IMPORT_FILE_NAME, IngredientServiceInterface::IMPORTS);
            $fileService->validateFileHeader($file);

            $fileRows = $fileService->extractRows($file);
            $ingredientService->bulkInsert($fileRows);

            return view('ingredients.check-upload-status');
        } catch (Exception $e) {
            return view('ingredients.error', ['error' => $e->getMessage()]);
        }

    }

    public function edit(string $slug): View
    {
        $ingredient = Ingredient::where('slug', $slug)->first();

        return view('ingredients.edit', ['ingredient' => $ingredient]);
    }

    public function update(UpdateIngredientRequest $request, string $slug): View
    {
        $validated  = $request->validated();
        $ingredient = Ingredient::where('slug', $slug)->first();

        $ingredient->update($validated);

        return view('ingredients.show');
    }

    public function search(SearchRequest $request, IngredientServiceInterface $service): View
    {
        $validated   = $request->validated();
        $ingredients = $service->search($validated['keyword']);

        return view(
            'ingredients.main',
            [
                'ingredients' => $ingredients,
            ]
        );
    }
}
