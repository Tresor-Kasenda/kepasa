<?php

declare(strict_types=1);

namespace App\Enums;

enum ReservationEnum: int
{
    case STATUS_ACTIVE = 1;

    case STATUS_INACTIVE = 0;
}
