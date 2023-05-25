<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdminLayout extends Component
{
    public function __construct()
    {
        //
    }

    public function render(): View|string|\Closure
    {
        return view('layouts.app');
    }
}
