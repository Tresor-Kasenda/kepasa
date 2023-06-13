<?php

declare(strict_types=1);

namespace App\Repository\Organisers;

use App\Models\OnlineEvent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use LaravelIdea\Helper\App\Models\_IH_OnlineEvent_QB;

class OnlineEventRepository
{
    public function joinRoom($attributes): Model|Builder|_IH_OnlineEvent_QB|OnlineEvent|null
    {
        return OnlineEvent::query()
            ->where('roomId', '=', $attributes)
            ->first();
    }
}
