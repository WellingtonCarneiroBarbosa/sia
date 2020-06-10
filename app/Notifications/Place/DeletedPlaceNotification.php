<?php

namespace App\Notifications\Place;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Lang;

class DeletedPlaceNotification extends Notification
{
    use Queueable;

    /**
     * Data of the place
     * that has deleted
     * 
     */
    public $place;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($place)
    {
        $this->place    = $place->name;
        $this->user     = $place->user;
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
                ->subject($this->user . " " . "excluiu permanentemente o local" . " " . $this->place . " " . "do sistema")
                ->greeting(Lang::get('Hello!'))
                ->line("<b>" . $this->user . "</b>" . " " .  "excluiu permanentemente o local" . " " . "<b>" . $this->place . "</b>" . " " . "do sistema" . ".")
                ->action(Lang::get('Visualizar Log'), "log.url")
                ->line(Lang::get('Não deseja receber mais notificações como esta') . "?")
                ->line(Lang::get('Para resolver isso, por favor, vá até as configurações de sua conta e desabilite as notificações via e-mail'));
    }
}
