<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

class TypeCustomer extends Enum
{
    public const COMPANY = 'company';

    public const USER = 'user';

    public static array $types = [self::COMPANY, self::USER];
}
