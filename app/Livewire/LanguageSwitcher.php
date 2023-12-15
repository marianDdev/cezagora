<?php

namespace App\Livewire;

use Livewire\Component;

class LanguageSwitcher extends Component
{
    public $language;

    public function mount()
    {
        $this->language      = 'en';
    }

    public function render()
    {
        return view('livewire.language-switcher');
    }
}

