<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomResetPassword extends Notification implements ShouldQueue
{
    use Queueable;

    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $frontendUrl = env('FRONTEND_URL', 'https://www.resumemansion.com');
        $resetUrl = $frontendUrl . '/reset-password?token=' . $this->token . '&email=' . urlencode($notifiable->username);

        return (new MailMessage)
            ->subject('Reset Your Password - Resume Mansion')
            ->view('emails.password-reset', [
                'user' => $notifiable,
                'resetUrl' => $resetUrl,
                'token' => $this->token
            ]);
    }
}
