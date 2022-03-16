<?php
declare(strict_types=1);
namespace App\Repository\Organisers;

use App\EnxRtc\Errors;
use App\Models\OnlineEvent;
use App\Repository\OrganiserRepositoryInterface;
use App\Services\EnableX\EnableXHttpService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class EnableXRepository implements OrganiserRepositoryInterface
{
    use EnableXHttpService;

    public function joinOnlineEvent($attributes)
    {
        $event = $this->joinRoomParticipant(attributes:  $attributes);

        $data = [
            "name"=> auth()->user()->name,
            "role"=> "moderator",
            "roomId"=> $event->roomId,
            "user_ref" => $event->reference,
            'duration' => $event->duration,
            'participants' => $event->participants,
            'scheduled_time' => $event->schedule
        ];

        if (!json_encode($event)){
            $error = Errors::getError('4001');
            $error["desc"] = "JSON keys missing: name, role or roomId";
            return $error;
        }

        $json_error = json_last_error();

        if ($json_error){
            $error = Errors::getError( "4003");
            $error["desc"] = $json_error;
            return $error;
        }

        if ($data['name'] && $data['role'] && $data['roomId']){
            $ret = $this->createToken($data);
            if ($ret){
                return [$ret, $data];
            }
        }else{
            $error = Errors::getError( "4004");
            $error["desc"] = "JSON keys missing: name, role or roomId";
            return $error;
        }
    }

    public function createToken($onlineEvent)
    {
        $token = [
            "name"			=> $onlineEvent['name'],
            "owner_ref"		=> $onlineEvent['user_ref'],
            'duration'      => $onlineEvent['duration'],
            'participants'  => $onlineEvent['participants'],
            'scheduled_time' => $onlineEvent['scheduled_time'],
            'scheduled'     => true,
            'user_ref'      => auth()->user()->name,
            'role'          => $onlineEvent['role']
        ];

        return $this->request()
            ->post(config('enablex.url')."rooms/". $onlineEvent['roomId']. "/tokens", $token)
            ->json();
    }

    public function joinRoomParticipant($attributes): Model|Builder|null
    {
        $key = $attributes->input('key');
        return OnlineEvent::getOnlineEvents(key: $key);
    }
}
