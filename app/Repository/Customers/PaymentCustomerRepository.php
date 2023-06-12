<?php

declare(strict_types=1);

namespace App\Repository\Customers;

use App\Enums\PaymentEnum;
use App\Mail\ConfirmationTransaction;
use App\Models\Event;
use App\Models\PaymentCustomer;
use App\Traits\PaypalConfiguration;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use Throwable;

class PaymentCustomerRepository
{
    use PaypalConfiguration;

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

        $total = $payment->prices * $attributes->input('ticketNumber');

        $provider = self::paypalConfiguration();
        $order = $provider->createOrder([
            'intent' => 'CAPTURE',
            'purchase_units' => [
                0 => [
                    'amount' => [
                        'currency_code' => 'USD',
                        'value' => $total,
                    ],
                ],
            ],
        ]);
        self::createOrder(order: $order, payment: $payment, data: $attributes);

        return response()->json($order);
    }

    /**
     * @throws Throwable
     */
    public function capture($attributes): JsonResponse
    {
        $data = json_decode($attributes->getContent(), true);
        $provider = self::paypalConfiguration();
        $order = $data['orderId'];
        $capture = $provider->capturePaymentOrder(order_id: $order);
        if ('COMPLETED' === $capture['status']) {
            self::updateOrder(capture: $capture);
            self::updateTicketNumber($attributes);
        }

        return response()->json($capture);
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

    private static function createOrder($order, $payment, $data): void
    {
        $total = $data->prices * $data->ticketNumber;
        PaymentCustomer::query()
            ->create([
                'event_id' => $payment->id,
                'user_id' => auth()->id(),
                'ticketNumber' => $data->ticketNumber,
                'totalAmount' => $total,
                'reference' => $order['id'],
                'status' => PaymentEnum::UNPAID,
            ]);
    }

    private static function updateOrder($capture): void
    {
        PaymentCustomer::query()
            ->where('reference', '=', $capture['id'])
            ->update([
                'status' => PaymentEnum::PAID,
                'updated_at' => Carbon::now(),
            ]);
    }
}
