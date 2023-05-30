<?php

declare(strict_types=1);

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Closure;

class AdminLayout extends Component
{
    public function __construct()
    {

    }

    public function render(): View|string|Closure
    {
        return view('layouts.app');
    }
}
