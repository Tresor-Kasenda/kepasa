<?php
declare(strict_types=1);

namespace App\Repository\Contracts;

use Illuminate\Http\JsonResponse;

interface OrganiserRepositoryInterface
{
    public function createdToken($attributes);
}
