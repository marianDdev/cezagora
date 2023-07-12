<?php

namespace App\Http\Controllers;

use App\Models\CompanyIngredient;
use App\Models\Ingredient;
use App\Services\File\FileServiceInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class IngredientController extends Controller
{
    public function index(): View
    {
        return view(
            'ingredients.index',
            [
                'ingredients' => CompanyIngredient::paginate(20),
            ]
        );
    }

    public function listMyIngredients(): View
    {
        $ingredients = CompanyIngredient::where('company_id', $this->authUserCompany()->id)->paginate(20);

        return view(
            'ingredients.index',
            [
                'ingredients' => $ingredients,
            ]
        );
    }

    public function show(string $slug): View
    {
        $ingredient = Ingredient::where('slug', $slug)->first();
        $companyIngredients = CompanyIngredient::where('ingredient_id', $ingredient->id)->get();

        if (is_null($ingredient)) {
            abort(404, 'Ingredient not found.');
        }

        return view(
            'ingredients.show',
            [
                'ingredients' => $companyIngredients,
                'name' => $ingredient->name,
                'description' => $ingredient->description,
                'function' => $ingredient->function,
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

    public function store()
    {
        //todo create RedirectIfUserHasNotAddedCompanyDetails
    }

    /**
     * @throws FileIsTooBig
     * @throws FileDoesNotExist
     */
    public function upload(FileServiceInterface $fileService): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $user = $this->authUser();

        $file = $user->addMediaFromRequest('import_file')
                     ->toMediaCollection('imports');

        $filename = storage_path('app/public/' . $file->id . '/' . $file->file_name);

        $fileService->storeContent('ingredient', $filename);

        return redirect('/ingredients');
    }
}
