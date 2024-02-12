<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactForm extends Mailable
{
    use Queueable, SerializesModels;

    protected $formData = [];
    /**
     * Create a new message instance.
     */
    public function __construct($formData)
    {
        $this->formData = $formData;
    }

    /**
     * @return ContactForm
     */
    public function build()
    {
        return $this->view('emails.contact_form')->with($this->formData);
    }
}
