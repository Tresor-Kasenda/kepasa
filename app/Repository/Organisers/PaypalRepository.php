<?php
declare(strict_types=1);

namespace App\Repository\Organisers;

use App\Models\Event;
use App\Services\Payment\PayPalPaymentServiceFactory;
use Illuminate\Http\JsonResponse;
use Srmklive\PayPal\Facades\PayPal;
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
        $order = PayPalPaymentServiceFactory::process(attributes:  $data, payment: $payment);
        $this->createOrder(attributes: $attributes, order: $order);
        return response()->json($order);
    }

    /**
     * @throws Throwable
     */
    public function capture($attributes): JsonResponse
    {
        $data = json_decode($attributes->getContent(), true);
        $process = PayPalPaymentServiceFactory::capture(attributes: $data);
        $this->updateOrder(attributes: $attributes, process: $process);
        return response()->json($process);
    }


    private function createOrder($attributes, $order)
    {

    }

    private function updateOrder($attributes, $process)
    {
    }

}
