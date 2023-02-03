<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RejetNotif extends Notification
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
        return ['database'];
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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
            'titre' => 'Demande non accepté',
            'notif1' => 'Cause: '.$this->motif,
            'notif2' => 'Vous pouvez encore réessayer de s\'abonner',
            'illustration' => 'cancel.png'
        ];
    }
}
