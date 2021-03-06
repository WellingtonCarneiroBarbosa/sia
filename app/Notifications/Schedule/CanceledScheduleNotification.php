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
        $this->user         = $schedule->user;
        $this->start        = dateTimeBrazilianFormat($schedule->start);
        $this->end          = dateTimeBrazilianFormat($schedule->end);
        $this->place        = $schedule->schedulingPlace['name'];
        $this->customer     = $schedule->schedulingCustomer['corporation'];
        $this->url          = route('schedules.show', ['id' => $schedule->id]); 
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
                ->subject($this->place . " " . "está DISPONÍVEL entre" . " " . $this->start . " " . "e" . " " . $this->end)
                ->greeting(Lang::get('Hello!'))
                ->line("<b>" . $this->user . "</b>" . " " . "cancelou o agendamento do(a) cliente" . " " . "<b>" . $this->customer . "</b>")
                ->line(Lang::get('Portanto, caso necessite') . ", " . "<b>" . $this->place . "</b>" . " " . "está DISPONÍVEL entre" . " " . "<b>" . $this->start . "</b>" . " " . "e" . " " . "<b>" . $this->end . "</b>")
                ->action(Lang::get('Mais detalhes'), $this->url)
                ->line(Lang::get('Não deseja receber mais notificações como esta') . "?")
                ->line(Lang::get('Para resolver isso, por favor, vá até as configurações de sua conta e desabilite as notificações via e-mail'));
    }
}
