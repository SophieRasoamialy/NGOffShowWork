<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NouveauProjetNotif extends Notification
{
    use Queueable;
    public $projet_titre, $projet_budget, $competence_requise;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($projet_titre, $projet_budget, $competence_requise)
    {
        $this->projet_titre = $projet_titre;
        $this->projet_budget = $projet_budget;
        $this->competence_requise = $competence_requise;
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
            'titre' => $this->projet_titre,
            'notif1' => $this->competence_requise,
            'notif2' => "Budget:".$this->projet_budget,
            'illustration' => 'icon_projet.png'
        ];
    }
}
