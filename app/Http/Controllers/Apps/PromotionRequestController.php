<?php
declare(strict_types=1);

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShareRequest;
use App\Notifications\SharedNotification;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class PromotionRequestController extends Controller
{
    public function __invoke(): Renderable
    {
        return view('apps.pages.cities.index');
    }

    public function store(ShareRequest $request): RedirectResponse
    {
        Notification::send($request->input('email'), new SharedNotification($request));
        return back()->with('success', "Message envoyer avec succes");
    }
}
