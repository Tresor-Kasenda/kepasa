<?php

declare(strict_types=1);

namespace App\Http\Controllers\Organisers\Events\Payments;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Repository\Organisers\Events\Payment\EventPaymentRepository;
use Illuminate\Http\RedirectResponse;

class PaymentConfirmationController extends Controller
{
    public function __construct(
        protected readonly EventPaymentRepository $repository
    ) {
    }

    public function updateCheckout(Event $event): RedirectResponse
    {
        $this->repository->updatePayment($event);

        return redirect()->route('organiser.events-list');
    }
}
