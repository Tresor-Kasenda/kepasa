<?php

declare(strict_types=1);

namespace App\Http\Controllers\Organisers;

use App\Http\Controllers\Controller;
use App\Repository\Organisers\CheckoutOrganiserRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CheckoutOrganiserController extends Controller
{
    public function __construct(public CheckoutOrganiserRepository $repository)
    {
    }

    public function confirmed(Request $attributes): RedirectResponse
    {
        $token = $this->repository->transactionWithDpo(attributes: $attributes);

        return redirect()->away("https://secure.3gdirectpay.com/dpopayment.php?ID={$token}");
    }

    public function updateCheckout(string $key): RedirectResponse
    {
        $this->repository->updatePayment(key: $key);

        return redirect()->route('organiser.events.index');
    }
}
