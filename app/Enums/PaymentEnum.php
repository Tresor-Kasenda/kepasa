<?php
declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

class PaymentEnum extends Enum
{
    const PAID = 'paid';
    const UNPAID = 'unpaid';

    public static array $types = [self::PAID, self::UNPAID];
}
