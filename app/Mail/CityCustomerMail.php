<?php

declare(strict_types=1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CityCustomerMail extends Mailable implements ShouldQueue
{
    use Queueable;
    use SerializesModels;

    public function __construct(public $promoted)
    {
    }

    public function build(): CityCustomerMail
    {
        return $this
            ->to($this->promoted['email'])
            ->subject('')
            ->view('emails.contact', [
                'contact' => $this->promoted,
            ]);
    }
}
