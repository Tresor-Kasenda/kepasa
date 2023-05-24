<?php

declare(strict_types=1);

namespace App\Http\Controllers\Supers;

use App\Http\Controllers\Controller;
use App\Repository\Suppers\BillingSupperRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class BillingSupperController extends Controller
{
    public function __construct(public BillingSupperRepository $repository)
    {
    }

    public function __invoke(): Renderable
    {
        $billings = $this->repository->getContents();

        return view('admins.pages.billings.index', compact('billings'));
    }

    public function show(string $key): Factory|View|Application
    {
        return view('admins.pages.billings.show', [
            'billing' => $this->repository->getBillingByKey(key: base64_decode($key)),
        ]);
    }

    public function invoice(string $key): Factory|View|Application
    {
        return view('admins.pages.billings.invoice', [
            'billing' => $this->repository->getBillingByKey(key: $key),
        ]);
    }
}
