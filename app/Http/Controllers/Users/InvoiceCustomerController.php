<?php

declare(strict_types=1);

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\PaymentCustomer;

class InvoiceCustomerController extends Controller
{
    public function __invoke(string $key)
    {
        $invoice = PaymentCustomer::query()
            ->where('key', '=', $key)
            ->where('user_id', '=', auth()->id())
            ->first();

        return view(
            'users.invoices.invoice', [
            'invoice' => $invoice->load(['event', 'user']),
            ]
        );
    }
}
