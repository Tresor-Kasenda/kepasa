<?php

declare(strict_types=1);

namespace App\Enums;

class TypeEnum
{
    public const ONLINE = 'online';

    public const PRESENCE = 'presence';

    public static array $types = [self::ONLINE, self::PRESENCE];
}
