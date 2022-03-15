<?php
declare(strict_types=1);

namespace App\Services\EnableX;

use App\Models\OnlineEvent;
use App\Services\RandomValue;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class CreateRoomService
{
    use RandomValue;

    public function storeOnlineEvent($attributes, $event): Model|Builder|OnlineEvent
    {
        $onlineEventCreate = $this->CreateRoom(event: $event);
        $currentTime = strtotime("".$event->date." ".$event->startTime."");
        $date =  date("Y-m-d H:i:s", $currentTime);
        return OnlineEvent::query()
            ->create([
                'event_id' => $event->id,
                'company_id' => $attributes->user()->company->id,
                'roomId' => $onlineEventCreate[0]['room_id'],
                'roomName' => $onlineEventCreate[0]['name'],
                'reference' => bin2hex(random_bytes(30)),
                'moderators' => $onlineEventCreate[1]['moderators'],
                'schedule' => $date,
                'mode' => $onlineEventCreate[1]['mode'],
                'participantsID' => $this->generateNumericValues(100000, 999999),
                'moderatorID' => $this->generateNumericValues(100000, 999999)
            ]);
    }

    private function CreateRoom($event): array
    {
        $participants = $event->ticketNumber;
        list($date, $duration) = $this->dateCalculation($event);
        $Room = $this->createRoomMeta($event, $participants, $duration, $date);
        $Room_Meta = json_encode($Room);
        $headers = array(
            'Content-Type: application/json',
            'Authorization: Basic '. base64_encode( env('ENABLE_ID') . ":". env('ENABLE_KEY'))
        );
        return $this->storedOnlineEvent($headers, $Room_Meta);

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

    private function storedOnlineEvent(array $headers, bool|string $Room_Meta): array
    {
        /* CURL POST Request */
        $ch = curl_init(config('enablex.url') . "/rooms");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $Room_Meta);
        $response = curl_exec($ch);
        curl_close($ch);
        $obj = (array)json_decode($response);
        $room = (array)$obj['room'];
        $settings = (array)$room['settings'];
        return [$room, $settings];
    }
}
