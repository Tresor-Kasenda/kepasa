<?php

declare(strict_types=1);

namespace App\Enums;

class CityPromotedEnum
{
    public const PROMOTION = 'promotion';

    public const NOTPROMOTED = 'notPromoted';

    public static array $cities = [self::PROMOTION, self::NOTPROMOTED];
}
