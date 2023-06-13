<?php

namespace App\Http\Controllers;

use App\Models\CompanyIngredient;
use App\Models\Ingredient;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class IngredientController extends Controller
{
    public function listMyIngredients(): View
    {
        /** @var User $user */
        $user = Auth::user();
        $company = $user->company;
        $ingredients = $company->ingredients;

        $ingredients->map(function ($ingredient) use ($company) {
            $companyIngredient = CompanyIngredient::where('company_id', $company->id)->where('ingredient_id', $ingredient->id)->first();
            $ingredient->price = $companyIngredient->price;
            $ingredient->quantity = $companyIngredient->quantity;
            $ingredient->company = $company->name;
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

    public function upload()
    {

    }
}
