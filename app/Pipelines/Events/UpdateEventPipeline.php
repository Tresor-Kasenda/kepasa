<?php

namespace App\Pipelines\Events;

use App\Enums\RoleEnum;
use App\Models\User;
use App\Notifications\NewAdminEventNotification;
use Illuminate\Support\Facades\Notification;

class UpdateEventPipeline
{
    public function handle($event, \Closure $next)
    {
        Notification::send(
            User::where('role_id', RoleEnum::ROLE_SUPER)->get(),
            new NewAdminEventNotification($event)
        );

        return $next($event);
    }
}
