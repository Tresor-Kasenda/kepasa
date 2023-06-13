<?php

declare(strict_types=1);

namespace App\Enums;

enum PaymentEnum: string
{
    case PAID = 'paid';

    case UNPAID = 'un_paid';
}
