<?php

declare(strict_types=1);

namespace App\Repository\Contracts;

interface OnlineRepositoryInterface
{
    public function createdToken($attributes): void;
}
