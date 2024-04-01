<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CredentialsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $credentials;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $credentials)
    {
        $this->user = $user;
        $this->credentials = $credentials;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.credentials')
                    ->with([
                        'credentials' => $this->credentials,
                    ]);
    }
}
