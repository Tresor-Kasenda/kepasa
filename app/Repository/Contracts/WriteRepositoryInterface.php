<?php

declare(strict_types=1);

namespace App\Repository\Contracts;

interface WriteRepositoryInterface
{
    public function created($attributes);

    public function updated($attributes, $key);
}
