<?php

namespace App\Notifications\Schedule;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Lang;

class CanceledScheduleNotification extends Notification
{
    use Queueable;

    /**
     * Schedule data
     * 
     */
    public $schedule;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($schedule)
    {
        $this->title = $schedule->title;
        $this->start = $schedule->start;
        $this->end = $schedule->end;
        $this->user_action = $schedule->user_id;
        $this->place = $schedule->place_id;
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
                    ->subject($this->place . " " . Lang::get('está livre entre') . " " . $this->start . " " .  "e" . " " . $this->end)
                    ->greeting(Lang::get('Hello!'))
                    ->line(Lang::get('O usuário') . " " . $this->user_action . " " . "cancelou o agendamento" . " " . $this->title)
                    ->line(Lang::get('Portanto, o local') . " " . $this->place . " " . "está livre entre" . " " . $this->start . " " . "e" . " " . $this->end)
                    ->line(Lang::get('Caso não deseje receber mais notificações, por favor, vá até as configurações de sua conta e desabilite as notificações'));
                    /**->action(Lang::get('Reset Password'), $url) */
    }
}
