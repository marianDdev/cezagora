<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Http\Requests\StoreIngredientRequest;
use App\Http\Requests\UpdateIngredientRequest;
use App\Models\Ingredient;
use App\Services\File\FileServiceInterface;
use App\Services\Ingredient\IngredientServiceInterface;
use App\Services\SearchServiceInterface;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Throwable;

class IngredientController extends Controller
{
    public function index(
        Request $request,
        IngredientServiceInterface $service
    ): View
    {
        $filtersData = $service->getFiltersData();
        $filters = collect($request->all())->filter()->all();

        $filtered = $service->filter($filters);

        return view('ingredients.main', [
            'allIngredients' => $filtersData['allIngredients'],
            'companies' => $filtersData['companies'],
            'functions' => $filtersData['functions'],
            'filteredIngredients' => $filtered,
        ]);


    }

    public function listMyIngredients(): View
    {
        $authCompany = $this->authUserCompany();
        $ingredients = $authCompany->ingredients()->orderByDesc('created_at')->paginate(12);

        return view(
            'ingredients.index',
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
        $validated = $request->validated();

        Ingredient::create($validated);

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
            $file     = $fileService->addToMediaCollection(IngredientServiceInterface::IMPORT_FILE_NAME, IngredientServiceInterface::IMPORTS);
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
        $validated = $request->validated();
        $ingredients = $service->search($validated['keyword']);

        return view(
            'ingredients.main',
            [
                'ingredients' => $ingredients,
            ]
        );
    }
}
