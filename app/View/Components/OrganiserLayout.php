<?php

declare(strict_types=1);

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class OrganiserLayout extends Component
{
    public function __construct()
    {
    }

    public function render(): View|Factory|Htmlable|string|Closure|Application
    {
        return view('layouts.organiser');
    }
}
