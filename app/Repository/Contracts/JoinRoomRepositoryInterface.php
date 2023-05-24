<?php

declare(strict_types=1);

namespace App\Repository\Contracts;

interface JoinRoomRepositoryInterface
{
    public function joinRoom($attributes);
}
