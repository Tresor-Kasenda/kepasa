<?php

declare(strict_types=1);

namespace App\Http\Controllers\Organisers\Events\Payments;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Repository\Organisers\Events\Payment\EventPaymentRepository;

class ConfirmPaymentController extends Controller
{
    public function __construct(
        protected readonly EventPaymentRepository $repository
    ) {
    }

    public function __invoke(Event $event): void
    {
        $this->repository->handle($event);
    }
}
