<?php

namespace App\Mail;

use App\Models\Credential;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CredentialUpdatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $credential;
    public $user;

    public function __construct(Credential $credential, $user)
    {
        $this->credential = $credential;
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('Credential Update Notification')
                    ->view('emails.credentials.updated');
    }
}
