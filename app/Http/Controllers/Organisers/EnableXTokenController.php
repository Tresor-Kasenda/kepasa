<?php

declare(strict_types=1);

namespace App\Http\Controllers\Organisers;

use App\Http\Controllers\Controller;
use App\Http\Requests\EnableXTokenRequest;
use App\Repository\Contracts\JoinRoomRepositoryInterface;
use App\Repository\Contracts\OnlineRepositoryInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class EnableXTokenController extends Controller
{
    public function __construct(
        public OnlineRepositoryInterface $repository,
        public JoinRoomRepositoryInterface $joinRoomRepository
    ) {
    }

    public function createToken(EnableXTokenRequest $attributes): RedirectResponse
    {
        $event = $this->repository->createdToken($attributes);

        return Redirect::route('organiser.enable.joinRoom', [
            'token' => $event[0]['token'],
            'roomId' => $event[1]['roomId'],
        ]);
    }

    public function joinRoom($event, $room): Factory|View|Application
    {
        $onlineEvent = $this->joinRoomRepository->joinRoom($room);

        return view('enableX.index', compact('onlineEvent', 'room', 'event'));
    }
}
