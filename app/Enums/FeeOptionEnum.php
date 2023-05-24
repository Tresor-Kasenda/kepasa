<?php

declare(strict_types=1);

namespace App\Enums;

class FeeOptionEnum
{
    public const Inclusive = 'Inclusive';

    public const Exclusive = 'Exclusive';

    public static array $types = [self::Inclusive, self::Exclusive];
}
