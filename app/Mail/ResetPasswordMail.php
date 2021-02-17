<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $token;
    private $email;

    /**
     * Create a new message instance.
     *
     * @param $token
     */
    public function __construct($token, $email)
    {
        $this->token = $token;
        $this->email = $email;
    }

    /**
     * Build the message.
     *a
     * @return $this
     */
    public function build()
    {
        return $this->from('info@boernaarburger.ml','Boer naar Burger')
            ->subject('Reset jouw Boer naar Burger wachtwoord')
            ->markdown('Email.passwordReset')->with([
                'token' => $this->token,
                'email' => $this->email
            ]);
    }
}
