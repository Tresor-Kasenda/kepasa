<?php
declare(strict_types=1);

namespace App\Http\Controllers\Organisers;

use App\Http\Controllers\Controller;
use App\Http\Requests\EnableXTokenRequest;
use App\Repository\OrganiserRepositoryInterface;

class EnableXTokenController extends Controller
{
    public function __construct(public OrganiserRepositoryInterface $repository){}

    public function createToken(EnableXTokenRequest $attributes)
    {
        $event = $this->repository->joinOnlineEvent($attributes);
    }
}
