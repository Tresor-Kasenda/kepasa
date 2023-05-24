<?php

declare(strict_types=1);

namespace App\Repository\Contracts;

interface CreateTokenRepositoryInterface
{
    public function createToken($onlineEvent);
}
