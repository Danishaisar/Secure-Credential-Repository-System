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

    /**
     * Create a new message instance.
     *
     * @param string $link The secure link for close kin to access credentials
     */
    public function __construct(string $link)
    {
        $this->link = $link;
    }

    /**
     * Build the message.
     *
     * This method returns the mailable object configured to send an email
     * with a subject line and using a markdown template.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Access Credentials Link')
                    ->markdown('emails.credentialsAccessLink', ['link' => $this->link]);
    }
}
