<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

class PaymentEnum extends Enum
{
    public const PAID = 'paid';

    public const UNPAID = 'unpaid';

    public static array $types = [self::PAID, self::UNPAID];
}
