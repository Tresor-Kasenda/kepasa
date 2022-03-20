<?php
declare(strict_types=1);

namespace App\Repository\Contracts;

interface PaymentRepositoryInterface
{
    public function pay($attributes);
}
