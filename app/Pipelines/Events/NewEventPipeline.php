<?php

namespace App\Pipelines\Events;

use App\Notifications\NewEventNotification;
use Illuminate\Support\Facades\Notification;

class NewEventPipeline
{
    public function handle($event, \Closure $next)
    {
        Notification::send($event->user, new NewEventNotification($event));

        return $next($event);
    }
}
