<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsletterConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $nome;
    public $cognome;
    public $email;

    public function __construct($nome = null, $cognome = null, $email = null)
    {
        $this->nome = $nome;
        $this->cognome = $cognome;
        $this->email = $email;
    }

    public function build()
    {
        return $this->subject('Conferma iscrizione alla newsletter')
                    ->view('mail.newsletter-confirmation');
    }
}
