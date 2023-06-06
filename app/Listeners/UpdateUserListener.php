<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Notifications\UpdateUserNotification;
use Illuminate\Support\Facades\Notification;

class UpdateUserListener
{
    public function __construct()
    {

    }

    public function handle($event): void
    {
        Notification::sendNow($event, new UpdateUserNotification());
    }
}
