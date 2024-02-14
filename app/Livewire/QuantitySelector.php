<?php

namespace App\Livewire;

use Livewire\Component;

class QuantitySelector extends Component
{
    public $quantity = 1; // Default quantity

    public function increment()
    {
        $this->quantity++;
    }

    public function decrement()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function render()
    {
        return view('livewire.quantity-selector');
    }
}
