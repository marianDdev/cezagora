<?php

namespace App\Http\Controllers;

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
    private const IMPORT_FILE_NAME = 'import_file';
    private const IMPORTS          = 'imports';



    public function index(): View
    {
        return view('ingredients.main', [
                'ingredients' => Ingredient::paginate(12),
            ]);
//        return view(
//            'ingredients.index',
//            [
//                'ingredients' => Ingredient::paginate(12),
//            ]
//        );
    }

    public function listMyIngredients(): View
    {
        $authCompany = $this->authUserCompany();

        return view(
            'ingredients.index',
            [
                'ingredients' => $authCompany->ingredients()->paginate(12),
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

        return redirect()->route('ingredient.create')
                         ->with(
                             [
                                 'successful_message' => 'Ingredient added successfully!',
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
