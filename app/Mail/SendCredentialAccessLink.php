<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendCredentialAccessLink extends Mailable
{
    use Queueable, SerializesModels;

    public $link;
    public $userName; // Variable to hold the name of the user
    public $emails; // Array of emails

    /**
     * Create a new message instance.
     *
     * @param array $emails Array of email addresses for recipients
     * @param string $link The secure link for recipients to access credentials
     * @param string $userName The name of the user
     */
    public function __construct(array $emails, string $link, string $userName)
    {
        $this->emails = $emails;
        $this->link = $link;
        $this->userName = $userName; // Assigning the user name
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->emails)
            ->subject('Access Credentials Link')
            ->view('emails.credentialsAccessLink');
    }
}
