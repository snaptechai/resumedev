<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Email extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data = [])
    {
        $this->data = $data;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Welcome to Resume Mansion! Your Account is Ready',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.email',
            with: ['data' => $this->data],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}