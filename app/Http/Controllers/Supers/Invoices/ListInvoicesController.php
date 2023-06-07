<?php

namespace App\Http\Controllers\Supers\Invoices;

use App\Http\Controllers\Controller;
use App\Repository\Suppers\InvoicesEventsRepository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class ListInvoicesController extends Controller
{
    public function __construct(
        protected readonly InvoicesEventsRepository $repository
    ){
    }

    public function __invoke(Request $request): Renderable
    {
        return view('admins.pages.billings.index', [
            'invoices' => $this->repository->getInvoices($request)
        ]);
    }
}
