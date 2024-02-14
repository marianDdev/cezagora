<?php

namespace App\Livewire;

use App\Models\Company;
use App\Traits\AuthUser;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\IngredientVariant;
use App\Models\Ingredient;

class AddIngredientVariantToCart extends Component
{
    use AuthUser;

    public ?int $selectedVariantId = null;
    public ?IngredientVariant $selectedVariant = null;
    public ?Ingredient $ingredient = null;
    public Collection $variants;
    public int $ingredientId;
    public int $quantity = 1;
    public ?Company $customer = null;

    public function mount($ingredientId): void
    {
        $this->ingredientId = $ingredientId;
        $this->ingredient = Ingredient::find($ingredientId);
        $this->variants = $this->ingredient->variants()->get();
        $this->customer = Auth::check() ? $this->authUserCompany() : null;

        if ($this->variants->isNotEmpty()) {
            $this->selectedVariantId = $this->variants->first()->id;
            $this->selectedVariant = IngredientVariant::find($this->selectedVariantId);
        }
    }

    public function updatedSelectedVariantId($value): void
    {
        $this->selectedVariant = IngredientVariant::find($value);
    }

    public function increment(): void
    {
        if ($this->quantity < $this->selectedVariant->quantity) {
            $this->quantity++;
        }
    }

    public function decrement(): void
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function render(): View
    {
        return view('livewire.add-ingredient-variant-to-cart');
    }
}
