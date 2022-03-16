<?php
declare(strict_types=1);

namespace App\Jobs;

use App\Services\EnableX\EnableXHttpService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class OnlineEventDeletedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, EnableXHttpService;

    public function __construct(public $event){}

    public function handle()
    {
        $this->request()->delete(config('enablex.url')."rooms/". $this->event->onlineEvent->roomId);
    }
}
