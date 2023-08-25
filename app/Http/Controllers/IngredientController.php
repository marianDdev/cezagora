<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIngredientRequest;
use App\Http\Requests\UpdateIngredientRequest;
use App\Models\CompanyIngredient;
use App\Models\Ingredient;
use App\Services\File\FileServiceInterface;
use App\Services\Ingredient\IngredientServiceInterface;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Throwable;

class IngredientController extends Controller
{
    private const IMPORT_FILE_NAME = 'import_file';
    private const IMPORTS          = 'imports';

    public function index(): View
    {
        return view(
            'ingredients.index',
            [
                'ingredients' => CompanyIngredient::paginate(12),
            ]
        );
    }

    public function listMyIngredients(): View
    {
        $ingredients = CompanyIngredient::where('company_id', $this->authUserCompany()->id)->paginate(12);

        return view(
            'ingredients.index',
            [
                'ingredients' => $ingredients,
            ]
        );
    }

    public function show(string $slug): View
    {
        $ingredient         = Ingredient::where('slug', $slug)->first();
        $companyIngredients = CompanyIngredient::where('ingredient_id', $ingredient->id)->get();

        if (is_null($ingredient)) {
            abort(404, 'Ingredient not found.');
        }

        return view(
            'ingredients.show',
            [
                'ingredients' => $companyIngredients,
                'name'        => $ingredient->name,
                'description' => $ingredient->description,
                'function'    => $ingredient->function,
            ]
        );
    }

    public function create(): View
    {
        $myIngredients  = $this->authUserCompany()->ingredients;
        $allIngredients = Ingredient::all();
        $newIngredients = $allIngredients->diff($myIngredients);

        return view(
            'ingredients.forms.create',
            [
                'myIngredients'  => $myIngredients,
                'newIngredients' => $newIngredients,
            ]
        );
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
            $file     = $fileService->addToMediaCollection(self::IMPORT_FILE_NAME, self::IMPORTS);
            $fileRows = $fileService->extractRows($file);
            $ingredientService->bulkInsert($fileRows);

            return view('ingredients.check-upload-status');
        } catch (Exception $e) {
            return view('ingredients.error', ['error' => $e->getMessage()]);
        }

    }

    public function store(StoreIngredientRequest $request): RedirectResponse
    {
        $validated  = $request->validated();
        $ingredient = Ingredient::create($validated);
        CompanyIngredient::create(
            [
                'company_id'    => $validated['company_id'],
                'ingredient_id' => $ingredient->id,
                'price'         => $validated['price'],
                'quantity'      => $validated['quantity'],
            ]
        );

        return redirect()->route('ingredient.create')
                         ->with(
                             [
                                 'successful_message' => 'Ingredient added successfully!',
                             ]
                         );
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
}
