<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Credential;
use App\Mail\CredentialUpdatedMail; // Make sure this line is correctly added

class CredentialUpdatedNotification extends Notification
{
    use Queueable;

    public $credential;
    public $user;

    public function __construct(Credential $credential, $user)
    {
        $this->credential = $credential;
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        // Ensure that you pass the email directly to the mailable
        return (new CredentialUpdatedMail($this->credential, $this->user))
                ->to($notifiable->routes['mail']); // Use the email set by the route method
    }
}
