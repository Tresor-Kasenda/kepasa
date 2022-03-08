<?php
declare(strict_types=1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomerMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * @return void
     */
    public function __construct(public $user){}

    public function build(): CustomerMail
    {
        return $this
            ->to($this->user['email'])
            ->subject('Felicitation')
            ->view('emails.registration');
    }
}
