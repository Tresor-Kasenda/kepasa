<?php
declare(strict_types=1);

namespace App\Services\EnableX;


class CreateRoomTokenService
{
    use EnableXHttpService;

    public function createToken($onlineEvent)
    {
        try {
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
        } catch (\Exception $exception){
            return back();
        }
    }
}
