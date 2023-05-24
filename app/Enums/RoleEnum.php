<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class RoleEnum extends Enum
{
    public const SUPER = 1;

    public const ADMIN = 2;

    public const ORGANISER = 3;

    public const USERS = 4;

    public static array $types = [
        self::ORGANISER,
        self::USERS,
    ];
}
