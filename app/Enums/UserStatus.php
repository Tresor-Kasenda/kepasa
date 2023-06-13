<?php

declare(strict_types=1);

namespace App\Enums;

enum UserStatus: int
{
    case STATUS_ACTIVE = 1;

    case STATUS_DEACTIVATE = 0;
}
