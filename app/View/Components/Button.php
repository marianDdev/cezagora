<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    public function __construct(
        public string $type,
        public string $title
    )
    {}

    public function render(): View|Closure|string
    {
        return view('components.button');
    }
}
