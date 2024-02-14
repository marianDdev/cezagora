<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIngredientVariantRequest;
use App\Models\IngredientVariant;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class IngredientVariantController extends Controller
{
    public function create(int $ingredientId): View
    {
        return view('ingredients.forms.create._variants', ['ingredientId' => $ingredientId]);
    }

    public function store(
        StoreIngredientVariantRequest   $request,
    ): RedirectResponse
    {
        $validated  = $request->validated();
        IngredientVariant::create($validated);

        return redirect()->route('my-ingredients')
                         ->with(['successful_message' => 'Ingredient added successfully!']);
    }
}
