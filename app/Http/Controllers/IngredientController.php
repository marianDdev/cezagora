<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterIngredientsRequest;
use App\Http\Requests\SearchRequest;
use App\Http\Requests\StoreIngredientRequest;
use App\Http\Requests\UpdateIngredientRequest;
use App\Models\Document;
use App\Models\Ingredient;
use App\Services\Document\DocumentServiceInterface;
use App\Services\Ingredient\IngredientServiceInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

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
        $documents = DocumentServiceInterface::ALL_DOCUMENTS;

        return view('ingredients.forms.create', ['documents' => $documents]);
    }

    public function store(StoreIngredientRequest $request, DocumentServiceInterface $documentService): RedirectResponse
    {
        $validated  = $request->validated();
        $ingredient = Ingredient::create($validated);

        if (!$ingredient instanceof Ingredient) {
            return redirect()->route('ingredient.create')
                             ->with(['error_message' => 'Something went wrong']);
        }

        if (array_key_exists('documents', $validated)) {
            $documentService->create($validated, $ingredient->id);
        }

        if (isset($validated['other_document'])) {
            $documentService->createOther($validated, $ingredient->id);
        }

        return redirect()->route('my-ingredients')
                         ->with(['successful_message' => 'Ingredient added successfully!']);
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
