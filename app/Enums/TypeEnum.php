<?php
declare(strict_types=1);

namespace App\Enums;

class TypeEnum
{
    const ONLINE = 'online';
    const PRESENCE = 'presence';

    public static array $types = [self::ONLINE, self::PRESENCE];
}
