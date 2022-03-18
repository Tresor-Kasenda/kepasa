<?php
declare(strict_types=1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TokenCreateMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public $token){}

    public function build()
    {
        return $this
            ->to($this->token['email'])
            ->subject('')
            ->view('emails.token', [
                'token' => $this->token
            ]);
    }
}
