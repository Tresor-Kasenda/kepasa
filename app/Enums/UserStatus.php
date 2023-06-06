<?php

declare(strict_types=1);

namespace App\Enums;

class UserStatus
{
    public const ACTIVE = 1;

    public const DEACTIVATE = 0;

    public static array $status = [
        self::ACTIVE,
        self::DEACTIVATE,
    ];
}
