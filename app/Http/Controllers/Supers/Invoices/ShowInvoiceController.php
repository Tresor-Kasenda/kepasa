<?php

declare(strict_types=1);

namespace App\Http\Controllers\Supers\Invoices;

use App\Http\Controllers\Controller;
use App\Models\Billing;

class ShowInvoiceController extends Controller
{
    public function __invoke(Billing $billing)
    {
        return view('admins.pages.invoice.show', [
            'invoice' => $billing->load(['event', 'user']),
        ]);
    }
}
