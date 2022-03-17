<?php
declare(strict_types=1);

namespace App\Services\EnableX;

use App\EnxRtc\Errors;
use Illuminate\Http\Request;

class JoinRoomService
{
    use EnableXHttpService;

    public function getRoom(Request $request)
    {
        $roomId = $request->route('room');
        if (!$roomId) {
            $error = Errors::getError(4001);
            $error["desc"] = "Failed to get roomId from URL";
            return response()->json($error);
        }

        return $this->request()
            ->post(config('enablex.url') ."rooms/", $roomId)
            ->json();
    }
}
