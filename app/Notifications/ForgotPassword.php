<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ForgotPassword extends Notification implements ShouldQueue
{
    use Queueable;

    private $userId;
    private $token;

    public function __construct($userId, $token)
    {

        $this->userId = $userId;
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Please click this button to reset your password.')
            ->action('Reset', 'https://peaceful-dusk-18159.herokuapp.com/password/reset/' . $this->userId . '/' . $this->token)
//            ->action('Reset', 'http://localhost:3000/password/reset/' . $this->userId . '/' . $this->token)
            ->line('Thank you for using FLY!');
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
