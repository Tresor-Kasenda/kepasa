<?php

declare(strict_types=1);

namespace App\Repository\Customers;

use App\Enums\PaymentEnum;
use App\Mail\ConfirmationTransaction;
use App\Models\Event;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use Throwable;

class PaymentCustomerRepository
{
    /**
     * @throws Throwable
     */
    public function pay($attributes): JsonResponse
    {
        $payment = Event::query()
            ->where('title', '=', $attributes->input('title'))
            ->where('prices', '=', $attributes->input('prices'))
            ->where('payment', '=', PaymentEnum::PAID)
            ->first();
    }

    public static function updateTicketNumber($attributes): Event|Builder|Model|null
    {
        $event = Event::query()
            ->where('title', '=', $attributes->input('title'))
            ->where('prices', '=', $attributes->input('prices'))
            ->first();
        $discount = $event->ticketNumber - $attributes->input('ticket');
        $event->update(['ticketNumber' => $discount]);
        Mail::send(new ConfirmationTransaction($event));

        return $event;
    }
}
