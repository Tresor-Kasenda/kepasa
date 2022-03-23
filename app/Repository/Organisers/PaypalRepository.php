<?php
declare(strict_types=1);

namespace App\Repository\Organisers;

use App\Enums\PaymentEnum;
use App\Models\Customer;
use App\Models\Event;
use App\Services\Payment\PayPalPaymentServiceFactory;
use Illuminate\Http\JsonResponse;
use Throwable;

class PaypalRepository
{
    /**
     * @throws Throwable
     */
    public function pay($attributes): JsonResponse
    {
        $payment = Event::query()
            ->where('title', '=', $attributes->input('title'))
            ->where('prices', '=', $attributes->input('prices'))
            ->first();
        $data = json_decode($attributes->getContent(), true);
        $order = PayPalPaymentServiceFactory::process(data:  $data, payment: $payment);
        dd($order);
        $this->createOrder(attributes: $data, order: $order, payment: $payment);
        $this->updateTicketEvent(event: $payment, data: $data);
        return $order;
    }

    /**
     * @throws Throwable
     */
    public function capture($attributes): JsonResponse
    {
        $data = json_decode($attributes->getContent(), true);
        $process = PayPalPaymentServiceFactory::capture(attributes: $data);
       $this->updateOrder(attributes: $attributes, process: $process);
        return $process;
    }


    private function createOrder($attributes, $order, $payment)
    {
        $total = $payment->prices * $payment->ticketNumber ;
        Customer::query()
            ->create([
                'event_id' => $payment->id,
                'user_id' => auth()->id(),
                'ticketNumber' => $payment->ticketNumber,
                'totalAmount' => $total,
                'reference' => $order->id,
                'name' => auth()->user()->company->companyName,
                'surname' => auth()->user()->lastName,
                'email' => auth()->user()->company->email,
                'phones' => auth()->user()->company->phones,
                'country' => auth()->user()->company->country,
                'city' => auth()->user()->company->country,
                'status' => PaymentEnum::UNPAID
            ]);
    }

    private function updateOrder($attributes, $process)
    {
    }

    private function updateTicketEvent($event, $data)
    {
        $tickets = $event->ticketNumber - $data->ticket;
        Event::query()
            ->where('id', '=', $event->id)
            ->where('title', '=', $event->title)
            ->update([
                'ticketNumber' => $tickets
            ]);
    }

}
