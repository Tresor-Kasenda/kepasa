<?php

namespace App\Http\Controllers\Supers\Invoices;

use App\Http\Controllers\Controller;
use App\Models\Billing;
use Illuminate\Http\Request;

class DownloadInvoiceController extends Controller
{
    public function __invoke(Billing $billing)
    {
        return view('admins.pages.billings.invoice', [
            'invoice' => $billing->load(['user', 'event']),
        ]);
    }
}
