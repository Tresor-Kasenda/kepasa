<?php

declare(strict_types=1);

namespace App\Http\Controllers\Organisers\Events\Payments;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Support\Facades\View;

class PaymentEventController extends Controller
{
    public function __invoke(Event $event)
    {
        return View::make('organisers.pages.events.payment.index', [
            'event' => $event->load(['category', 'country', 'city']),
        ]);
    }
}
