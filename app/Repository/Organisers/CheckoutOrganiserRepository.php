<?php

declare(strict_types=1);

namespace App\Repository\Organisers;

use App\Enums\PaymentEnum;
use App\Mail\PaymentConfirmationMail;
use App\Models\Customer;
use App\Models\Event;
use App\Services\Payment\DpoPaymentFactory;
use App\Traits\RandomValue;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class CheckoutOrganiserRepository
{
    use RandomValue;

    public function getCategoryByEvent($event)
    {
        return $event->load(['category', 'user']);
    }

    public function transactionWithDpo($attributes)
    {
        $event = Event::query()
            ->where('title', '=', $attributes->input('title'))
            ->where('date', '=', $attributes->input('date'))
            ->firstOrFail();
        self::createTransaction(event: $event, attributes: $attributes);

        return DpoPaymentFactory::pay(event: $event, attributes: $attributes);
    }

    public function updatePayment(string $key): Model|Builder|null
    {
        $event = Event::query()
            ->where('key', '=', $key)
            ->where('user_id', '=', auth()->id())
            ->where('company_id', '=', auth()->user()->company->id)
            ->first();
        $event->update([
            'payment' => PaymentEnum::PAID,
        ]);
        $this->updateTransaction(event: $event);
        Mail::send(new PaymentConfirmationMail(auth()->user(), $event));
        toast('Transaction made with success', 'success');

        return $event;
    }

    private function createTransaction($event, $attributes): void
    {
        $total = $event->ticketNumber * $event->prices;
        Customer::query()
            ->create([
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
            ]);
    }

    private function updateTransaction($event): void
    {
        Customer::query()
            ->where('user_id', '=', auth()->id())
            ->where('event_id', '=', $event->id)
            ->where('name', '=', auth()->user()->company->companyName)
            ->update([
                'status' => PaymentEnum::PAID,
            ]);
    }
}
