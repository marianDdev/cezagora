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
                'ingredients' => CompanyIngredient::all(),
            ]
        );
    }

    public function listMyIngredients(): View
    {
        $ingredients = CompanyIngredient::where('company_id', $this->authUserCompany()->id)->get();

        return view(
            'ingredients.index',
            [
                'ingredients' => $ingredients,
            ]
        );
    }

    public function show(Ingredient $ingredient): View
    {
        $user = $this->authUser();

        $paymentIntent = $user->createSetupIntent();

        return view(
            'layouts.checkout',
            [
                'ingredient' => $ingredient,
                'intent'     => $paymentIntent,
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
        //
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
