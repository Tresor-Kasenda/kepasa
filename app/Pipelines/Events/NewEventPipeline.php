<?php

declare(strict_types=1);

namespace App\Pipelines\Events;

use App\Notifications\NewEventNotification;
use Illuminate\Support\Facades\Notification;
use Closure;

class NewEventPipeline
{
    public function handle($event, Closure $next)
    {
        Notification::send($event->user, new NewEventNotification($event));

        return $next($event);
    }
}
