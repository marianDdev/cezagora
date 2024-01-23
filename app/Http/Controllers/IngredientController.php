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
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Pagination\LengthAwarePaginator;

class IngredientController extends Controller
{
    public function index(FilterIngredientsRequest $request, IngredientServiceInterface $service): View
    {
        $validated   = $request->validated();
        $filtersData = $service->getFiltersData();
        $filtered    = $service->filter($validated)->sortByDesc('created_at');

        $page    = request('page', 1);
        $perPage = 15;
        $offset  = ($page - 1) * $perPage;

        $filtered = new LengthAwarePaginator(
            $filtered->slice($offset, $perPage)->values(),
            $filtered->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

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
        $authCompanyDocuments = $authCompany->documents()->pluck('documents.name')->toArray();
        $documents = array_unique(array_merge($authCompanyDocuments, DocumentServiceInterface::ALL_DOCUMENTS));

        return view(
            'ingredients.my_ingredients',
            [
                'authCompany' => $authCompany,
                'ingredients' => $ingredients,
                'documents'   => $documents,
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

    public function update(
        UpdateIngredientRequest $request,
        IngredientServiceInterface $service
    ): RedirectResponse|View {
        $validated  = $request->validated();

        try {
            $service->update($validated);
        } catch (Exception $e) {
            return view('ingredients.error', ['error' => $e->getMessage()]);
        }


        return redirect()->route('my-ingredients');
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
