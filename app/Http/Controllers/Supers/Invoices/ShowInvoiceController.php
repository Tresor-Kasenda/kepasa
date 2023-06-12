<?php

declare(strict_types=1);

namespace App\Http\Controllers\Supers\Invoices;

use App\Http\Controllers\Controller;
use App\Models\Customer;

class ShowInvoiceController extends Controller
{
    public function __invoke(Customer $customer)
    {
        return view('admins.pages.invoice.show', [
            'invoice' => $customer->load(['event', 'user']),
        ]);
    }
}
