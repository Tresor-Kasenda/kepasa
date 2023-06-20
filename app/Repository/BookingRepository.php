<?php

declare(strict_types=1);

namespace App\Repository;

use App\Enums\PaymentEnum;
use App\Enums\StatusEnum;
use App\Mail\CustomerTransactionMail;
use App\Models\Event;
use App\Traits\GetSingleEvent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class BookingRepository
{
    use GetSingleEvent;

    public function confirmedPayment($attributes)
    {
        return Event::query()
            ->where('title', '=', $attributes->input('title'))
            ->where('date', '=', $attributes->input('date'))
            ->when('city', fn ($query) => $query->where('city', $attributes->input('city')))
            ->where('status', '=', StatusEnum::STATUS_ACTIVE)
            ->firstOrFail();
    }

    public function updatePayment(): Model|Builder|null
    {
        $event = Event::query()
            ->where('user_id', '=', auth()->id())
            ->where('company_id', '=', auth()->user()->company->id)
            ->first();
        $event->update(
            [
            'payment' => PaymentEnum::PAID,
            ]
        );
        Mail::send(new CustomerTransactionMail(auth()->user(), $event));
        toast('Transaction made with success', 'success');

        return $event;
    }
}
