<?php
declare(strict_types=1);

namespace App\Repository\Organisers;

use App\Models\Event;
use App\Services\Payment\PayPalPaymentServiceFactory;
use Srmklive\PayPal\Facades\PayPal;
use Throwable;

class PaypalRepository
{
    /**
     * @throws Throwable
     */
    public function pay($attributes)
    {
        $payment = Event::query()
            ->where('title', '=', $attributes->input('title'))
            ->where('prices', '=', $attributes->input('prices'))
            ->first();
        $paypalService = PayPalPaymentServiceFactory::process(attributes:  $attributes, payment: $payment);
    }
}
