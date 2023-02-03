<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DeleteUserNotif extends Notification
{
    use Queueable;
    public $motif;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($motif)
    {
        $this->motif = $motif;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Suppression ')
                    ->greeting('Bonjour,')
                    ->line('Pour des raisons inexplicables,   NGOffShowWork a dû vous enlever dae la plateforme pour cause : '.$this->motif)
                    ->line('Merci,');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
