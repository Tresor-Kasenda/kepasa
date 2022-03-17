<?php
declare(strict_types=1);

namespace App\Http\Controllers\Organisers;

use App\Http\Controllers\Controller;
use App\Http\Requests\EnableXTokenRequest;
use App\Http\Requests\JoinRoomRequest;
use App\Repository\Contracts\OrganiserRepositoryInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class EnableXTokenController extends Controller
{
    public function __construct(public OrganiserRepositoryInterface $repository){}

    public function createToken(EnableXTokenRequest $attributes): RedirectResponse
    {
        $event = $this->repository->createdToken($attributes);
        return redirect()->route('organiser.enable.joinRoom', compact('event'));
    }

    public function joinRoom(JoinRoomRequest $attributes): Factory|View|Application
    {
        return view('enableX.index');
    }
}
