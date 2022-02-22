<?php
declare(strict_types=1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EventCreated extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public $event){}

    public function build(): EventCreated
    {
        return $this
            ->from('no-replay@eventall.com', 'Kepasa')
            ->view('emails.event')
            ->with([
                'name' => "Creation de l'evenement",
                'link' => route(''),
                'room' => $this->event
            ]);
    }
}
