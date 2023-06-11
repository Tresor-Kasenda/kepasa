<?php

declare(strict_types=1);

namespace App\Services\EnableX;

use App\Models\OnlineEvent;
use App\Traits\RandomValue;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use JetBrains\PhpStorm\ArrayShape;

class CreateRoomService
{
    use EnableXHttpService;
    use RandomValue;

    public function handle($request, $event): Model|Builder|OnlineEvent
    {
        $onlineEventCreate = $this->CreateOnlineRoom(event: $event);
        $currentTime = strtotime(''.$event->date.' '.$event->startTime.'');
        $date = date('Y-m-d H:i:s', $currentTime);

        return OnlineEvent::query()
            ->create([
                'event_id' => $event->id,
                'company_id' => $request->user()->company->id,
                'roomId' => $onlineEventCreate['room']['room_id'],
                'roomName' => $onlineEventCreate['room']['name'],
                'reference' => $onlineEventCreate['room']['owner_ref'],
                'moderators' => $onlineEventCreate['room']['settings']['moderators'],
                'schedule' => $date,
                'duration' => $onlineEventCreate['room']['settings']['duration'],
                'participants' => $onlineEventCreate['room']['settings']['participants'],
                'mode' => $onlineEventCreate['room']['settings']['mode'],
                'participantsID' => $this->generateNumericValues(100000, 999999),
                'moderatorID' => $this->generateNumericValues(100000, 999999),
            ]);
    }

    private function CreateOnlineRoom($event)
    {
        $participants = $event->ticketNumber;
        [$date, $duration] = $this->calculationDateOfEvent($event);
        $Room = $this->renderMetadataForRoom($event, $participants, $duration, $date);

        return $this->request()
            ->post(config('enablex.url').'rooms/', $Room)
            ->json();

    }

    private function calculationDateOfEvent($event): array
    {
        $currentTime = strtotime(''.$event->date.' '.$event->startTime.'');
        $date = date('Y-m-d H:i:s', $currentTime);
        $array1 = explode(':', $event->startTime);
        $array2 = explode(':', $event->endTime);
        $minutes1 = ($array1[0] * 60.0 + $array1[1]);
        $minutes2 = ($array2[0] * 60.0 + $array2[1]);
        $duration = $minutes2 - $minutes1;
        $hoursToAdd = -2;
        $secondsToAdd = $hoursToAdd * (60 * 60);
        $newTime = $currentTime + $secondsToAdd;
        $date = date('Y-m-d H:i:s', $newTime);

        return [$date, $duration];
    }

    #[ArrayShape(['name' => 'string', 'owner_ref' => 'int', 'settings' => 'array', 'sip' => 'false[]'])]
    private function renderMetadataForRoom($event, mixed $participants, float|string $duration, string $date): array
    {
        return [
            'name' => ''.$event->title,
            'owner_ref' => $this->generateNumericValues(100000, 999999),
            'settings' => [
                'description' => ''.$event->description,
                'quality' => 'SD',
                'mode' => 'group',
                'participants' => $participants,
                'duration' => ''.$duration,
                'moderators' => '2',
                'scheduled' => false, // il doit etre a vraie pour  les rooms momentanee
                'scheduled_time' => ''.$date,
                'auto_recording' => false,
                'active_talker' => true,
                'wait_moderator' => false,
                'adhoc' => false,
                'canvas' => true,
            ],
            'sip' => [
                'enabled' => false,
            ],
        ];
    }
}
