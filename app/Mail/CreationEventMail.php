<?php
declare(strict_types=1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CreationEventMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public $event, public $attributes){}

    public function build()
    {
        return $this
            ->to($this->attributes['user']['email'])
            ->subject('')
            ->view('emails.createEvent', [
                'event' => $this->event
            ]);
    }
}
