<?php

declare(strict_types=1);

namespace App\Enums;

enum EventTypeEnum: string
{
    case EVENT_ONLINE = 'event_online';

    case EVENT_PRESENCE = 'event_presence';
}
