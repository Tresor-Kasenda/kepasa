<?php

declare(strict_types=1);

namespace App\Enums;

enum CityEnum: string
{
    case APPROVAL_PROMOTION = 'promotion';

    case APPROVAL_NOT_PROMOTION = 'not_promotion';
}
