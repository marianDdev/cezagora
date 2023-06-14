<?php

namespace App\Http\Livewire;

use App\Models\CompanyCategory;
use Illuminate\Support\Collection;
use Livewire\Component;

class OtherCompanyCategory extends Component
{
    public Collection $categories;
    public $otherCategory;

    public function mount()
    {
        $this->categories = CompanyCategory::TYPES;
        $this->otherCategory      = null;
    }

    public function render()
    {
        return view('livewire.other-company-category');
    }
}
