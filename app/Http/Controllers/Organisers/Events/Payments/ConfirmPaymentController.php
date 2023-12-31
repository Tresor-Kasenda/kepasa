<?php

declare(strict_types=1);

namespace App\Http\Controllers\Organisers\Events\Payments;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Repository\Organisers\Events\Payment\EventPaymentRepository;
use Illuminate\Http\Request;

class ConfirmPaymentController extends Controller
{
    public function __construct(
        protected readonly EventPaymentRepository $repository
    ) {
    }

    public function __invoke(Event $event, Request $request)
    {
        $token = $this->repository->handle($event, $request);

        return redirect()->away("https://secure.3gdirectpay.com/dpopayment.php?ID={$token}");
    }
}
