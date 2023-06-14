<?php

namespace App\Http\Controllers;

use App\Models\CompanyIngredient;
use App\Models\Ingredient;
use App\Models\User;
use App\Services\File\FileServiceInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class IngredientController extends Controller
{
    public function listMyIngredients(): View
    {
        /** @var User $user */
        $user        = Auth::user();
        $company     = $user->company;
        $ingredients = $company->ingredients;

        $ingredients->map(function ($ingredient) use ($company) {
            $companyIngredient    = CompanyIngredient::where('company_id', $company->id)->where('ingredient_id', $ingredient->id)->first();
            $ingredient->price    = $companyIngredient->price;
            $ingredient->quantity = $companyIngredient->quantity;
            $ingredient->company  = $company->name;
        });

        return view('ingredients.index', ['ingredients' => $ingredients]);
    }

    public function create(): View
    {
        /** @var User $user */
        $user           = Auth::user();
        $myIngredients  = $user->company->ingredients;
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
        /** @var User $user */
        $user = Auth::user();

        $file = $user->addMediaFromRequest('import_file')
                       ->toMediaCollection('imports');

        $filename = storage_path('app/public/' . $file->id . '/' . $file->file_name);

        $fileService->storeContent('ingredient', $filename);

        return redirect('/ingredients');
    }
}
