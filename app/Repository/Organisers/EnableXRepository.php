<?php

declare(strict_types=1);

namespace App\Repository\Organisers;

use App\EnxRtc\Errors;
use App\Mail\TokenCreateMail;
use App\Models\OnlineEvent;
use App\Repository\Contracts\OnlineRepositoryInterface;
use App\Services\EnableX\CreateRoomTokenService;
use App\Services\EnableX\EnableXHttpService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class EnableXRepository implements OnlineRepositoryInterface
{
    use EnableXHttpService;

    public function createdToken($attributes): JsonResponse|array
    {
        $event = $this->getOnlineEventByKey(attributes: $attributes);

        $data = [
            'name' => auth()->user()->name,
            'role' => 'moderator',
            'roomId' => $event->roomId,
            'user_ref' => $event->reference,
            'duration' => $event->duration,
            'participants' => $event->participants,
            'scheduled_time' => $event->schedule,
        ];

        if ($data['name'] && $data['role'] && $data['roomId']) {
            $token = new CreateRoomTokenService();
            Mail::send(new TokenCreateMail($token));

            return [
                $token->createToken($data),
                $data,
            ];
        }
        $error = Errors::getError(4004);
        $error['desc'] = 'JSON keys missing: name, role or roomId';

        return response()->json($error);
    }

    public function getOnlineEventByKey($attributes): Model|Builder|null
    {
        $key = $attributes->input('key');

        return OnlineEvent::getOnlineEvents(key: $key);
    }
}
