<?php

declare(strict_types=1);

namespace App\Traits;

use Srmklive\PayPal\Services\PayPal;
use Throwable;

trait PaypalConfiguration
{
    /**
     * @throws Throwable
     */
    private static function paypalConfiguration(): PayPal
    {
        $provider = new PayPal();
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        return $provider;
    }
}
