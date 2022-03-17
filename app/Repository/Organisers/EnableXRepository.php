<?php
declare(strict_types=1);

namespace App\Repository\Organisers;

use App\EnxRtc\Errors;
use App\Models\OnlineEvent;
use App\Repository\Contracts\OrganiserRepositoryInterface;
use App\Services\EnableX\CreateRoomTokenService;
use App\Services\EnableX\EnableXHttpService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class EnableXRepository implements OrganiserRepositoryInterface
{
    use EnableXHttpService;

    public function createdToken($attributes)
    {
        $event = $this->getOnlineEventByKey(attributes:  $attributes);

        $data = [
            "name"              => auth()->user()->name,
            "role"              => "moderator",
            "roomId"            => $event->roomId,
            "user_ref"          => $event->reference,
            'duration'          => $event->duration,
            'participants'      => $event->participants,
            'scheduled_time'    => $event->schedule
        ];

        if ($data['name'] && $data['role'] && $data['roomId']){
            $error = Errors::getError(4004);
            $error["desc"] = "JSON keys missing: name, role or roomId";
            return response()->json($error);
        }
        $token = new CreateRoomTokenService();
        return $token->createToken($data);
    }

    public function getOnlineEventByKey($attributes): Model|Builder|null
    {
        $key = $attributes->input('key');
        return OnlineEvent::getOnlineEvents(key: $key);
    }
}
