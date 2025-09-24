<?php

namespace App\Mail;

use App\Models\Message;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WriterMessage extends Mailable
{
       use Queueable, SerializesModels;

    public $data;

    public function __construct($maildata = [])
    {
        $this->data = $maildata;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Message Received from Client !',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.writer-message',
            with: ['data' => $this->data],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}