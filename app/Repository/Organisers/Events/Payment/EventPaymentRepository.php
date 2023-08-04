<?php

declare(strict_types=1);

namespace App\Repository\Organisers\Events\Payment;

use App\Enums\PaymentEnum;
use App\Enums\TypeCustomer;
use App\Exceptions\CustomerException;
use App\Http\Controllers\Organisers\Events\Payments\ConfirmPaymentController;
use App\Mail\PaymentConfirmationMail;
use App\Models\Customer;
use App\Models\Event;
use App\Notifications\HostCustomerNotification;
use App\Services\Payment\DpoPaymentFactory;
use App\Traits\RandomValue;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class EventPaymentRepository
{
    use RandomValue;

    public function handle(Event $event, Request $request)
    {
        if (Customer::query()->where('event_id', '=', $event->id)->where('user_id', '=', auth()->id())->exists()) {
            throw new CustomerException('You have already made a transaction for this event');
        }

        DB::transaction(function () use ($event, $request) {
            $total = ($event->ticket_number * $event->prices);
            $customer = Customer::query()
                ->create([
                    'user_id' => auth()->id(),
                    'event_id' => $event->id,
                    'type' => TypeCustomer::TYPE_COMPANY,
                    'ticket_number' => $event->ticket_number,
                    'prices' => $event->prices,
                    'total_amount' => $total,
                    'status' => PaymentEnum::UNPAID,
                ]);
            Notification::send($event->user, new HostCustomerNotification($customer));
            return $customer;
        });

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

    private function updateTransaction($event): void
    {
        Customer::query()
            ->where('user_id', '=', auth()->id())
            ->where('event_id', '=', $event->id)
            ->where('name', '=', auth()->user()->company->companyName)
            ->update(['status' => PaymentEnum::PAID]);
    }
}
