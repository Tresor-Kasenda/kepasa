<?php
declare(strict_types=1);

namespace App\Repository\Organisers;

use App\Models\Event;
use App\Repository\Contracts\PaymentRepositoryInterface;

class PaypalRepository implements PaymentRepositoryInterface
{
    public function pay($attributes)
    {
        $payment = Event::query()
            ->where('title', '=', $attributes->input('title'))
            ->where('prices', '=', $attributes->input('prices'))
            ->first();
        dd($payment, $attributes);
    }
}
