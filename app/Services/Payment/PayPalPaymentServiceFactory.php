<?php

declare(strict_types=1);

namespace App\Services\Payment;

use App\Enums\PaymentEnum;
use App\Mail\ConfirmationTransaction;
use App\Models\Customer;
use App\Models\Event;
use App\Traits\PaypalConfiguration;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use Throwable;

class PayPalPaymentServiceFactory
{
    use PaypalConfiguration;

    /**
     * @throws Throwable
     */
    public static function process($data, $payment): JsonResponse
    {
        $provider = self::paypalConfiguration();
        $total = $payment->prices * $payment->ticketNumber;
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
        self::createOrder(order: $order, payment: $payment);

        return response()->json($order);
    }

    /**
     * @throws Throwable
     */
    public static function capture($attributes): JsonResponse
    {
        $provider = self::paypalConfiguration();
        $order = $attributes['orderId'];
        $capture = $provider->capturePaymentOrder(order_id: $order);
        if ('COMPLETED' === $capture['status']) {
            self::updateOrder(attributes: $attributes, process: $capture);
            self::updateEvent();
        }

        return response()->json($capture);
    }

    public static function updateEvent(): bool|int
    {
        $event = Event::query()
            ->where('user_id', '=', auth()->id())
            ->where('company_id', '=', auth()->user()->company->id)
            ->update([
                'payment' => PaymentEnum::PAID,
                'updated_at' => now(),
            ]);
        Mail::send(new ConfirmationTransaction($event));

        return $event;
    }

    private static function createOrder($order, $payment): void
    {
        $total = $payment->prices * $payment->ticketNumber;
        Customer::query()
            ->create([
                'event_id' => $payment->id,
                'user_id' => auth()->id(),
                'ticketNumber' => $payment->ticketNumber,
                'totalAmount' => $total,
                'reference' => $order['id'],
                'name' => auth()->user()->company->companyName,
                'surname' => auth()->user()->lastName,
                'email' => auth()->user()->company->email,
                'phones' => auth()->user()->company->phones,
                'country' => auth()->user()->company->country,
                'city' => auth()->user()->company->country,
                'status' => PaymentEnum::UNPAID,
            ]);
    }

    private static function updateOrder($attributes, $process): void
    {
        Customer::query()
            ->where('reference', '=', $process['id'])
            ->update([
                'status' => PaymentEnum::PAID,
                'updated_at' => now(),
            ]);
    }
}
