<?php
declare(strict_types=1);

namespace App\Enums;

class CityPromotedEnum
{
    const PROMOTION = 'promotion';
    const NOTPROMOTED = 'notPromoted';
    public static array $cities = [self::PROMOTION, self::NOTPROMOTED];
}
