<?php

namespace App\Notifications\Customer;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Lang;

class DeletedCustomerNotification extends Notification
{
    use Queueable;

    /**
     * Data of the customer
     * that has deleted
     * 
     */
    public $customer;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($customer)
    {
        $this->customer = $customer->corporation;
        $this->user     = $customer->user;
        $this->url      = route('customers.show', ['id' => $customer->id]);
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
                ->subject($this->user . " " . "deletou o(a) cliente" . " " . $this->customer . " " . "do sistema")
                ->greeting(Lang::get('Hello!'))
                ->line("<b>" . $this->user . "</b>" . " " .  "deletou o(a) cliente" . " " . "<b>" . $this->customer . "</b>" . " " . "do sistema" . ".")
                ->action(Lang::get('Mais detalhes'), $this->url)
                ->line(Lang::get('Não deseja receber mais notificações como esta') . "?")
                ->line(Lang::get('Para resolver isso, por favor, vá até as configurações de sua conta e desabilite as notificações via e-mail'));
    }

}
