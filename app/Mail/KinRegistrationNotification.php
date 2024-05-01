<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class KinRegistrationNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $kin_name;
    public $relation;

    public function __construct($kin_name, $relation)
    {
        $this->kin_name = $kin_name;
        $this->relation = $relation;
    }

    public function build()
    {
        return $this->subject('Notification of Registration Update')
                    ->view('emails.kinNotification')
                    ->with([
                        'kin_name' => $this->kin_name,
                        'relation' => $this->relation
                    ]);
    }
}
