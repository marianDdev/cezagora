<?php

namespace App\Http\Controllers;

use App\Models\CompanyIngredient;
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

        return view('components.ingredients-table', ['ingredients' => $ingredients]);
    }
}
