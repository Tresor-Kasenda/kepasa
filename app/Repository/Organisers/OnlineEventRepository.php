<?php
declare(strict_types=1);

namespace App\Repository\Organisers;

use App\Models\OnlineEvent;
use App\Repository\Contracts\JoinRoomRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class OnlineEventRepository implements JoinRoomRepositoryInterface
{

    public function joinRoom($attributes): Model|Builder|OnlineEvent|null
    {
        return OnlineEvent::query()
            ->where('roomId', '=', $attributes)
            ->first();
    }
}
