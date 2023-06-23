<?php

declare(strict_types=1);

namespace App\Repository\Organisers\Events\Payment;

use App\Enums\PaymentEnum;
use App\Mail\PaymentConfirmationMail;
use App\Models\Customer;
use App\Models\Event;
use App\Services\Payment\DpoPaymentFactory;
use App\Traits\RandomValue;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EventPaymentRepository
{
    use RandomValue;

    public function handle(Event $event, Request $request)
    {
        self::createTransaction(event: $event);

        return (new DpoPaymentFactory())->pay($event, $request);
    }

    public function updatePayment(Event $event): Model|Builder|null
    {
        $event->update(
            [
                'payment' => PaymentEnum::PAID,
            ]
        );
        $this->updateTransaction(event: $event);
        Mail::send(new PaymentConfirmationMail(auth()->user(), $event));
        toast('Transaction made with success', 'success');

        return $event;
    }

    private function createTransaction($event): void
    {
        $total = $event->ticketNumber * $event->prices;
        Customer::query()
            ->create(
                [
                    'event_id' => $event->id,
                    'user_id' => auth()->id(),
                    'ticketNumber' => $event->ticketNumber,
                    'totalAmount' => $total,
                    'reference' => $this->generateNumericValues(1000, 999999),
                    'name' => auth()->user()->company->companyName,
                    'surname' => auth()->user()->lastName,
                    'email' => auth()->user()->company->email,
                    'phones' => auth()->user()->company->phones,
                    'country' => auth()->user()->company->country,
                    'city' => auth()->user()->company->country,
                ]
            );
    }

    private function updateTransaction($event): void
    {
        Customer::query()
            ->where('user_id', '=', auth()->id())
            ->where('event_id', '=', $event->id)
            ->where('name', '=', auth()->user()->company->companyName)
            ->update(['status' => PaymentEnum::PAID]);
    }
}
