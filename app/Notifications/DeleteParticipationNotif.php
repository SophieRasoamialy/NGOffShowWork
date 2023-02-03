<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DeleteParticipationNotif extends Notification
{
    use Queueable;
    public $projet_titre = '';
    public $motif;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($projet_titre, $motif)
    {

        $this->projet_titre = $projet_titre;
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
        return ;
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
            'titre' => 'Annulation',
            'notif1' => "On vous a retiré du projet ".$this->projet_titre." , mais vous pouvez encore réessayer!",
            'notif2' => 'Cause: '.$this->motif,
            'illustration' => 'cancel.png'
        ];
    }
}
