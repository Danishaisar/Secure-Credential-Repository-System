<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\DeathCertificate; // Add this import

class DeathCertificateVerifiedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $deathCertificate;

    public function __construct(DeathCertificate $deathCertificate)
    {
        $this->deathCertificate = $deathCertificate;
    }

    public function build()
    {
        return $this->subject('Death Certificate Verified')
                    ->view('emails.deathCertificateVerified');
    }
}
