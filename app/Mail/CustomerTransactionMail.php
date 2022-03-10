<?php
declare(strict_types=1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomerTransactionMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public $user, public $event){}


    public function build(): CustomerTransactionMail
    {
        return $this
            ->to($this->user['email'])
            ->subject('')
            ->view('emails.event', [
                'events' => $this->event
            ]);
    }
}
