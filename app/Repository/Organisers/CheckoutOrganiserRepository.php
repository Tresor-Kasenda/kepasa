<?php
declare(strict_types=1);

namespace App\Repository\Organisers;

use App\Enums\PaymentEnum;
use App\Mail\PaymentConfirmationMail;
use App\Models\Event;
use App\Models\PaymentCustomer;
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
            'payment' => PaymentEnum::PAID
        ]);
        $this->updateTransaction(event: $event);
        Mail::send(new PaymentConfirmationMail(auth()->user(), $event));
        toast("Transaction made with success", 'success');
        return $event;
    }

    private function updateTransaction($event)
    {
        $total = $event->ticketNumber * $event->prices;
        PaymentCustomer::query()
            ->create([
                'event_id' => $event->id,
                'user_id' => auth()->id(),
                'ticketNumber' => $event->ticketNumber,
                'totalAmount' => $total,
                'reference' => $this->generateNumericValues(1000, 999999),
                'status' => PaymentEnum::PAID
            ]);
    }
}
