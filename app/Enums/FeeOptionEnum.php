<?php
declare(strict_types=1);

namespace App\Enums;

class FeeOptionEnum
{
    const Inclusive = 'Inclusive';
    const Exclusive = 'Exclusive';
    public static $types = [self::Inclusive, self::Exclusive];
}
