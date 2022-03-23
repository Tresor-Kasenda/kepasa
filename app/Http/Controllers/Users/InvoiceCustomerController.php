<?php
declare(strict_types=1);

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\PaymentCustomer;
use Illuminate\Contracts\Support\Renderable;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class InvoiceCustomerController extends Controller
{
    public function download(string $key): Renderable
    {
        $invoice = PaymentCustomer::query()
            ->where('key', '=', $key)
            ->where('user_id', '=', auth()->id())
            ->first();
        return view('users.invoices.invoice', [
            'invoice' => $invoice->load(['event', 'user']),
        ]);
    }
}
