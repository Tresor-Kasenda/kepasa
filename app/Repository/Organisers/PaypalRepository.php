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
        return PayPalPaymentServiceFactory::process(data:  $data, payment: $payment);
    }

    /**
     * @throws Throwable
     */
    public function capture($attributes): JsonResponse
    {
        $data = json_decode($attributes->getContent(), true);
        return PayPalPaymentServiceFactory::capture(attributes: $data);
    }
}
