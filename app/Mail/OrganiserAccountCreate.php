<?php
declare(strict_types=1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrganiserAccountCreate extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public $user){}

    public function build(): static
    {
        return $this
            ->from('no-replay@kepasa.com', 'Kepasa')
            ->view('emails.registration')
            ->with(['name' => "Creation de l'evenement", 'user' => $this->user]);
    }
}
