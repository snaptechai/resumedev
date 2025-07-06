<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewOrder extends Mailable
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
            subject: 'New Order Received!',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.new-order',
            with: ['data' => $this->data],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}