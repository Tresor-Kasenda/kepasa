<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class RoleEnum extends Enum
{
    const SUPER =   1;
    const ADMIN =   2;
    const ORGANISER = 3;
    const CUSTOMER = 4;

    public static array $types = [
        self::ORGANISER,
        self::CUSTOMER,
    ];
}
