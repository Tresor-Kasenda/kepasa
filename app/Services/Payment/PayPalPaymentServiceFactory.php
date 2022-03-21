<?php
declare(strict_types=1);

namespace App\Services\Payment;

use Srmklive\PayPal\Facades\PayPal;
use Throwable;

class PayPalPaymentServiceFactory
{
    /**
     * @throws Throwable
     */
    public static function process($attributes, $payment)
    {
        $data = json_decode($attributes->getContent(), true);
        $provider = PayPal::setProvider();
        $provider->setApiCredentials(config('paypal'));
        $token = $provider->getAccessToken();
        $provider->setAccessToken($token);

        $order = $provider->createOrder([
            'intent' => "CAPTURE",
            'purchase_units' => [
                'amount' => [
                    'currency_code' => "USD",
                    'value' => $payment
                ]
            ]
        ]);
    }
}
