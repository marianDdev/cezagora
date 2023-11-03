<?php

namespace App\Livewire;

use App\Services\Ingredient\IngredientServiceInterface;
use Livewire\Component;

class ShowAvailableAt extends Component
{
    public array $availabilityTypes;
    public $availableAt;

    public function mount()
    {
        $this->availabilityTypes = IngredientServiceInterface::AVAILABILITY_TYPES;
        $this->availableAt      = null;
    }

    public function render()
    {
        return view('livewire.show-available-at');
    }
}
