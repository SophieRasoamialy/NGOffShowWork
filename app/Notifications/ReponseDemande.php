<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReponseDemande extends Notification
{
    use Queueable;
    public $valide, $date;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($valide)
    {
        $this->valide = $valide;
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
        if($this->valide == 1)
        {
            return (new MailMessage)
                    ->subject('Reponse de la demande de partenariat avec nom Appli')
                    ->greeting('Bonjour!')
                    ->line('Suite à votre demande de partenariat , nous tenons à vous remercier pour votre confiance. Nous tenons aussi à vous confirmer notre accord pour faire partie de notre partenaire.')
                    ->line('Vous pouvez déjà visiter votre espace en cliquant sur ce lien en bas')
                    ->action('Visiter votre espace', url('/liste_projet'))
                    ->line('Merci à vous!');
        }
        else
        {
            return (new MailMessage)
                    ->subject('Reponse de la demande de partenariat avec nom Appli')
                    ->greeting('Bonjour!')
                    ->line('Suite à votre demande de partenariat le , nous tenons à vous remercier pour votre confiance. Et malheureusement, nous ne pouvons pas accepter votre demande.')
                    ->line('Merci de reéssayer!');
        }
        
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
            
        ];
    }
}
