<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Component;
use App\Models\IngredientVariant;
use App\Models\Ingredient;

class IngredientVariantSelector extends Component
{
    public ?int               $selectedVariantId = null;
    public ?IngredientVariant $selectedVariant   = null;
    public ?Ingredient        $ingredient        = null;
    public Collection         $variants;
    public int                $ingredientId;

    public function mount($ingredientId): void
    {
        $this->ingredientId = $ingredientId;
        $this->ingredient   = Ingredient::find($ingredientId);
        $this->variants     = $this->ingredient->variants()->get();

        if ($this->variants->isNotEmpty()) {
            $this->selectedVariantId = $this->variants->first()->id;
            $this->selectedVariant   = IngredientVariant::find($this->selectedVariantId);
        }
    }

    public function updatedSelectedVariantId($value): void
    {
        $this->selectedVariant = IngredientVariant::find($value);
    }

    public function render(): View
    {
        return view('livewire.ingredient-variant-selector');
    }
}
