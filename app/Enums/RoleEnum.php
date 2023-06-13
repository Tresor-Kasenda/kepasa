<?php

declare(strict_types=1);

namespace App\Enums;

enum RoleEnum: int
{
    case ROLE_SUPER = 1;
    case ROLE_ORGANISER = 2;
    case ROLE_USERS = 3;
}
