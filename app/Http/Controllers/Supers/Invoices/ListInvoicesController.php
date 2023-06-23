<?php

declare(strict_types=1);

namespace App\Http\Controllers\Supers\Invoices;

use App\Http\Controllers\Controller;
use App\Repository\Suppers\CustomersRepository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class ListInvoicesController extends Controller
{
    public function __construct(
        protected readonly CustomersRepository $repository
    ) {
    }

    public function __invoke(Request $request): Renderable
    {
        return view(
            'admins.pages.invoice.index',
            [
                'invoices' => $this->repository->getInvoices($request),
            ]
        );
    }
}
