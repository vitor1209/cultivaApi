<?php


namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
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
        return (new MailMessage)
            ->subject('Recuperação de Senha')
            ->line('Aqui está o seu token de recuperação de senha:')
            ->line($this->token)
            ->line('Use este token no site para criar uma nova senha.')
            ->line('Se você não solicitou a recuperação, ignore este email.')
            ->line('Abraços, Cultiva+.');

    }
}
