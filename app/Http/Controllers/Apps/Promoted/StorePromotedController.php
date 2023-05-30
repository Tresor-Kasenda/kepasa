<?php

declare(strict_types=1);

namespace App\Http\Controllers\Apps\Promoted;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShareRequest;
use App\Mail\CityCustomerMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Notification;

class StorePromotedController extends Controller
{
    public function __invoke(ShareRequest $request): RedirectResponse
    {
        Notification::send($request->input('email'), new CityCustomerMail($request));

        return back()->with('success', 'Your request has sended with successful');
    }
}
