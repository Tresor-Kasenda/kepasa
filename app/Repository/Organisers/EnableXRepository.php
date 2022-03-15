<?php
declare(strict_types=1);
namespace App\Repository\Organisers;

use App\EnxRtc\Errors;
use App\Models\OnlineEvent;
use App\Repository\OrganiserRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;

class EnableXRepository implements OrganiserRepositoryInterface
{
    public function joinOnlineEvent($attributes)
    {
         $event = $this->joinRoomParticipant(attributes:  $attributes);

        $data = [
            "name"=> auth()->user()->name,
            "role"=> "moderator",
            "roomId"=> $event->roomId,
            "user_ref" => auth()->user()->name
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
            return json_encode($error);
        }

        if ($data['name'] && $data['role'] && $data['roomId']){
            $ret = $this->createToken($data);
            dd($ret);
            if ($ret){
                $result = json_decode($ret,true);
                if($result['token']){
                    echo "<script>window.location.href ='../../room/index.php?token=".$result['token']."&roomId=".$event->roomId."&role=".$event->role."&user_ref=".$event->user_ref."&event=".$event."';</script>'";
                } else {
                    echo "<script>window.location.href =document.referrer;</script>";
                    exit;
                }
            }
        }else{
            $error = $ARR_ERROR["4004"];					// Required JSON Key missing
            $error["desc"] = "JSON keys missing: name, role or roomId";
            $error = json_encode($error);
            //print $error;
            echo "<script>window.location.href =document.referrer;</script>";
            exit;
        }
    }

    public function createToken($onlineEvent): bool|string
    {
        $Token = Array(
            "name"			=> $onlineEvent['name'],
            "role"			=> $onlineEvent['role'],
            "user_ref"		=> $onlineEvent['user_ref']
        );
        $Token_Payload = json_encode($Token);
        $headers = array(
            'Content-Type: application/json',
            'Authorization: Basic '. base64_encode(config('enablex.app_id') . ":". config('enablex.app_key'))
        );

        $ch = curl_init(config('enablex.url')."/rooms/". $data->roomId . "/tokens");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $Token_Payload);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    public function joinRoomParticipant($attributes)
    {
        $key = $attributes->input('key');
        return OnlineEvent::getOnlineEvents(key: $key);
    }

    private function getOnlineEvent(string $key): Model|Builder|OnlineEvent|null
    {
        return OnlineEvent::query()
            ->where('reference', '=', $key)
            ->first();
    }
}
