<?php
declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class StatusEnum extends Enum
{
    const ACTIVE =  'active';
    const DEACTIVATE =   'deactivate';
    const POSTPONE = 'postpone';

    public static array $status = [
        self::ACTIVE,
        self::DEACTIVATE,
        self::POSTPONE,
    ];
}
