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
        StoreIngredientVariantRequest $request,
    ): RedirectResponse
    {
        $validated = $request->validated();
        $variant   = IngredientVariant::create($validated);

        if ($validated['button_name'] === 'add_another') {
            $message = sprintf(
                'Variant %d %s at price %s Euro of ingredient %s was successfully added',
                $variant->size,
                $variant->unit,
                $variant->price / 100,
                $variant->ingredient->common_name ?? $variant->ingredient->name,
            );

            return redirect()
                ->route('ingredient.variant.create', ['ingredientId' => $validated['ingredient_id']])
                ->with(['successful_message' => $message]);
        }

        return redirect()
            ->route('my-ingredients')
            ->with(['successful_message' => 'Ingredient added successfully!']);
    }
}
