<?php

declare(strict_types=1);

namespace App\Enums;

enum StatusEnum: string
{
    case STATUS_ACTIVE = 'status_active';
    case STATUS_DEACTIVATE = 'status_deactivate';
    case STATUS_POSTPONE = 'status_postpone';
}
