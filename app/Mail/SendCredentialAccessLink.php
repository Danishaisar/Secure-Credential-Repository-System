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
    public $userName;
    public $emails;
    public $videoPath; // Variable to hold the video path

    /**
     * Create a new message instance.
     *
     * @param array $emails Array of email addresses for recipients
     * @param string $link The secure link for recipients to access credentials
     * @param string $userName The name of the user
     * @param string|null $videoPath The path to the agreement video, if any
     */
    public function __construct(array $emails, string $link, string $userName, ?string $videoPath = null)
    {
        $this->emails = $emails;
        $this->link = $link;
        $this->userName = $userName;
        $this->videoPath = $videoPath; // Assigning the video path variable
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
            ->view('emails.credentialsAccessLink')
            ->with([
                'userName' => $this->userName,
                'link' => $this->link,
                'videoPath' => $this->videoPath
            ]);
    }
}
