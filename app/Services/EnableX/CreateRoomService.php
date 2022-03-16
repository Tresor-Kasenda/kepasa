<?php
declare(strict_types=1);

namespace App\Services\EnableX;

use App\Models\OnlineEvent;
use App\Services\RandomValue;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class CreateRoomService
{
    use RandomValue, EnableXHttpService;

    public function storeOnlineEvent($attributes, $event): Model|Builder|OnlineEvent
    {
        $onlineEventCreate = $this->CreateRoom(event: $event);
        $currentTime = strtotime("".$event->date." ".$event->startTime."");
        $date =  date("Y-m-d H:i:s", $currentTime);
        return OnlineEvent::query()
            ->create([
                'event_id' => $event->id,
                'company_id' => $attributes->user()->company->id,
                'roomId' => $onlineEventCreate['room']['room_id'],
                'roomName' => $onlineEventCreate['room']['name'],
                'reference' => $onlineEventCreate['room']['owner_ref'],
                'moderators' => $onlineEventCreate['room']['settings']['moderators'],
                'schedule' => $date,
                'duration' => $onlineEventCreate['room']['settings']['duration'],
                'participants' => $onlineEventCreate['room']['settings']['participants'],
                'mode' => $onlineEventCreate['room']['settings']['mode'],
                'participantsID' => $this->generateNumericValues(100000, 999999),
                'moderatorID' => $this->generateNumericValues(100000, 999999)
            ]);
    }

    private function CreateRoom($event)
    {
        $participants = $event->ticketNumber;
        list($date, $duration) = $this->dateCalculation($event);
        $Room = $this->createRoomMeta($event, $participants, $duration, $date);
        $Room_Meta = json_encode($Room);

        return $this->request()
            ->post(config('enablex.url') ."rooms/", $Room)
            ->json();

    }

    private function dateCalculation($event): array
    {
        $currentTime = strtotime("" . $event->date . " " . $event->startTime . "");
        $date = date("Y-m-d H:i:s", $currentTime);
        $array1 = explode(':', $event->startTime);
        $array2 = explode(':', $event->endTime);
        $minutes1 = ($array1[0] * 60.0 + $array1[1]);
        $minutes2 = ($array2[0] * 60.0 + $array2[1]);
        $duration = $minutes2 - $minutes1;
        $hoursToAdd = -2;
        $secondsToAdd = $hoursToAdd * (60 * 60);
        $newTime = $currentTime + $secondsToAdd;
        $date = date("Y-m-d H:i:s", $newTime);
        return [$date, $duration];
    }

    private function createRoomMeta($event, mixed $participants, float|string $duration, string $date): array
    {
        return array(
            "name" => "" . $event->title,
            "owner_ref" => $this->generateNumericValues(100000, 999999),
            "settings" => array(
                "description" => "". $event->description,
                "quality" => "SD",
                "mode" => "group",
                "participants" => $participants,
                "duration" => "" . $duration,
                "moderators" => "2",
                "scheduled" => true,
                "scheduled_time" => "" . $date,
                "auto_recording" => false,
                "active_talker" => true,
                "wait_moderator" => false,
                "adhoc" => false,
                "canvas" => true
            ),
            "sip" => array(
                "enabled" => false
            )
        );
    }
}
