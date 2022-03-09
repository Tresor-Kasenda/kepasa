<?php
declare(strict_types=1);

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShareRequest;
use App\Mail\CityCustomerMail;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Notification;

class PromotionRequestController extends Controller
{
    public function __invoke(): Renderable
    {
        return view('apps.pages.cities.index');
    }

    public function store(ShareRequest $request): RedirectResponse
    {
        Notification::send($request->input('email'), new CityCustomerMail($request));
        return back()->with('success', "Message envoyer avec succes");
    }
}
