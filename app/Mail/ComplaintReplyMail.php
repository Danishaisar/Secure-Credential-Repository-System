<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ComplaintReplyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reply;
    public $ticketNumber;

    public function __construct($reply, $ticketNumber)
    {
        $this->reply = $reply;
        $this->ticketNumber = $ticketNumber;
    }

    public function build()
    {
        return $this->subject('Complaint Reply')
                    ->view('emails.complaint_reply');
    }
}
