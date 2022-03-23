<?php
declare(strict_types=1);

namespace App\Services\Payment;

use Illuminate\Http\JsonResponse;
use Psr\Http\Message\StreamInterface;
use Srmklive\PayPal\Services\PayPal;
use Throwable;

class PayPalPaymentServiceFactory
{
    /**
     * @throws Throwable
     */
    public static function process($attributes, $payment): array|StreamInterface|string
    {
        $provider = self::paypalConfiguration();
        $total = $payment->prices * $attributes->ticket;
        return $provider->createOrder([
            'intent' => "CAPTURE",
            'purchase_units' => [
                'amount' => [
                    'currency_code' => "USD",
                    'value' => $total
                ],
                'description' => $payment->title
            ]
        ]);
    }

    /**
     * @throws Throwable
     */
    public static function capture($attributes): array|StreamInterface|string
    {
        $order = $attributes['orderId'];
        $provider = self::paypalConfiguration();
        return $provider->capturePaymentOrder(order_id: $order);
    }

    /**
     * @throws Throwable
     */
    private static function paypalConfiguration(): PayPal
    {
        $provider = new PayPal;
        $provider->setApiCredentials(config('paypal'));
        $token = $provider->getAccessToken();
        $provider->setAccessToken($token);
        return $provider;
    }
}
