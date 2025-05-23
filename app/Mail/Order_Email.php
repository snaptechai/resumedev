<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Order_Email extends Mailable
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
            subject: 'Thank You for Your Order – Let’s Get Started!',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.place_order',
            with: ['data' => $this->data],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}