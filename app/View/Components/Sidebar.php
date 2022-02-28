<?php
declare(strict_types=1);

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sidebar extends Component
{
    /**
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @return View|\Closure|string
     */
    public function render(): View|string|\Closure
    {
        return view('apps.components.sidebar');
    }
}
