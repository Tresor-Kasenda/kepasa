<?php

declare(strict_types=1);

namespace App\Enums;

enum TypeCustomer: string
{
    case TYPE_COMPANY = 'type_company';

    case TYPE_USER = 'type_user';
}
