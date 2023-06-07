<?php

declare(strict_types=1);

namespace App\Http\Controllers\Supers;

use App\Http\Controllers\Controller;
use App\Repository\Suppers\InvoicesEventsRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class BillingSupperController extends Controller
{
    public function __construct(public InvoicesEventsRepository $repository)
    {
    }

    public function invoice(string $key): Factory|View|Application
    {
        return view('admins.pages.billings.invoice', [
            'billing' => $this->repository->getBillingByKey(key: $key),
        ]);
    }
}
