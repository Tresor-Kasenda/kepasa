<?php
declare(strict_types=1);

namespace App\Repository;

use Illuminate\Http\JsonResponse;

interface OrganiserRepositoryInterface
{
    public function joinOnlineEvent($attributes);

    public function joinRoomParticipant($attributes);

    public function createToken($onlineEvent);
}
