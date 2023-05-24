<?php

declare(strict_types=1);

namespace App\Http\Controllers\Supers;

use App\Http\Controllers\Controller;
use App\Repository\Suppers\ChartJsSuperRepository;
use Illuminate\Contracts\Support\Renderable;

class HomeSuperController extends Controller
{
    public function __construct(public ChartJsSuperRepository $repository)
    {
    }

    public function __invoke(): Renderable
    {
        return view('admins.supper', [
            'companies' => [],
            'events' => [],
            'billings' => [],
        ]);
    }
}
