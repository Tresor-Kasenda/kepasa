<?php
declare(strict_types=1);

namespace App\Services\EnableX;

use App\Services\RandomValue;

class CreateRoomService
{
    use RandomValue;

    public function __construct(public $event, public $attributes){}

    public function createRoom(): array
    {
        $participants = $this->event->ticketNumber;
        $currentTime = strtotime("".$this->event->date." ".$this->event->startTime."");
        $array1 = explode(':', $this->event->startTime);
        $array2 = explode(':', $this->event->endTime);
        $minutes1 = ($array1[0] * 60.0 + $array1[1]);
        $minutes2 = ($array2[0] * 60.0 + $array2[1]);
        $duration  =  $minutes2 - $minutes1;
        //subtract 2 hours
        //The amount of hours that you want to add.
        $hoursToAdd = -2;
        //Convert the hours into seconds.
        $secondsToAdd = $hoursToAdd * (60 * 60);
        //Add the seconds onto the current Unix timestamp.
        $newTime = $currentTime + $secondsToAdd;
        $date =  date("Y-m-d H:i:s", $newTime);
        /* Create Room Meta */
        $Room = array(
            "name"      => "".$this->event->title,
            "owner_ref"   => $this->generateNumericValues(1000, 9999),
            "settings"    => array(
                "description" => "",
                "quality"   => "SD",
                "mode"      => "group",
                "participants"  => $participants,
                "duration"    => "".$duration,
                "moderators" => "2",
                "scheduled"   => true,
                "scheduled_time" => "".$date,
                "auto_recording"=> false,
                "active_talker" => true,
                "wait_moderator"=> false,
                "adhoc"     => false,
                "canvas"    => true
            ),
            "sip"    => array(
                "enabled"   => false
            )
        );
        $Room_Meta = json_encode($Room);
        /* Prepare HTTP Post Request */
        $headers = array(
            'Content-Type: application/json',
            'Authorization: Basic '. base64_encode(env('ENABLE_ID') . ":". env('ENABLE_KEY'))
        );

        /* CURL POST Request */
        $ch = curl_init(env('ENABLE_URL')."/rooms");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $Room_Meta);
        $response = curl_exec($ch);
        curl_close($ch);
        $obj = (array)json_decode($response);
        $room = (array)$obj['room'];
        $sip = (array)$obj['sip'];
        $settings = (array)$room['settings'];
        return [$room,$sip, $settings];
    }
}
