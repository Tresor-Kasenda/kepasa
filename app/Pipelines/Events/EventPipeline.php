<?php

namespace App\Pipelines\Events;

use App\Models\Event;
use Illuminate\Pipeline\Pipeline;

class EventPipeline extends Pipeline
{
    protected $pipes = [
        NewEventPipeline::class,
        UpdateEventPipeline::class,
    ];

    public static function run(Event $event)
    {
        return app(static::class)->send($event)->thenReturn();
    }
}
