<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReviewSentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $description;

    public function __construct($description)
    {
        $this->description = $description;
    }

    public function build()
    {
        return $this->subject('Resume Mansion AI Review')
                    ->view('emails.review_sent');
    }
}