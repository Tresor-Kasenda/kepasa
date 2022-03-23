<?php
declare(strict_types=1);

namespace App\Services\Payment;

use Illuminate\Http\JsonResponse;
use Srmklive\PayPal\Services\PayPal;
use Throwable;

class PayPalPaymentServiceFactory
{
    /**
     * @throws Throwable
     */
    public static function process($data, $payment): JsonResponse
    {
        $provider = self::paypalConfiguration();
        $total = $payment->prices * $payment->ticketNumber;
        $order = $provider->createOrder([
            'intent' => "CAPTURE",
            "purchase_units" => [
                0 => [
                    "amount" => [
                        'currency_code' => "USD",
                        'value' => $total
                    ]
                ]
            ]
        ]);
        return response()->json($order);
    }

    /**
     * @throws Throwable
     */
    public static function capture($attributes): JsonResponse
    {
        dd($attributes);
        $provider = self::paypalConfiguration();
        $order = $attributes['orderId'];
        $capture = $provider->capturePaymentOrder(order_id: $order);
        return response()->json($capture);
    }

    /**
     * @throws Throwable
     */
    private static function paypalConfiguration(): PayPal
    {
        $provider = new PayPal;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        return $provider;
    }
}
