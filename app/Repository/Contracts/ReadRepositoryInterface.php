<?php

declare(strict_types=1);

namespace App\Repository\Contracts;

interface ReadRepositoryInterface
{
    public function getElementByKey(string $key): void;

    public function delete($key): void;
}
