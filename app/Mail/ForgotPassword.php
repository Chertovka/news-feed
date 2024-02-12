<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPassword extends Mailable
{
    use Queueable, SerializesModels;

    protected $password;
    /**
     * Create a new message instance.
     */
    public function __construct($password)
    {
        $this->password = $password;
    }

    public function build()
    {
        return $this->view('emails.forgot')->with(["password" => $this->password]);
    }
}
