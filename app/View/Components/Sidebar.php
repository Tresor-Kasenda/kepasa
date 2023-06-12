<?php

declare(strict_types=1);

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sidebar extends Component
{
    public function __construct()
    {
    }

    public function render(): View|string|Closure
    {
        return view('apps.components.sidebar');
    }
}
