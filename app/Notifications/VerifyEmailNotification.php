<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\URL;

class VerifyEmailNotification extends Notification
{
    use Queueable;

    /**
     * The callback that should be used to build the mail message.
     *
     * @var \Closure|null
     */
    public static $toMailCallback;

    public function __construct($email, $defaultPassword)
    {
        $this->email = $email;
        $this->defaultPassword = $defaultPassword;
    }

    /**
     * Get the notification's channels.
     *
     * @param  mixed  $notifiable
     * @return array|string
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $verificationUrl);
        }

        $login = $notifiable->getEmailForPasswordReset();

        return (new MailMessage)
            ->subject(Lang::get('Verify Email Address'))
            ->greeting(Lang::get('Hello!'))
            ->line(Lang::get('You have been registered by a system administrator') . ".")
            ->line(Lang::get('Attention to your login details') . ":")
            ->line('Login: ' . $this->email)
            ->line(Lang::get('Default Passowrd') . ": " . $this->defaultPassword)
            ->line(Lang::get('Click the button below to check your email and use the system'))
            ->action(Lang::get('Verify Email Address'), $verificationUrl)
            ->line(Lang::get('Remember, this email is valid for 60 minutes') . ".")
            ->line(Lang::get('If it has expired, log in and request another') . ".")
            ->line(Lang::get('If you think this is a mistake, no action is needed') . ".");
    }

    /**
     * Get the verification URL for the given notifiable.
     *
     * @param  mixed  $notifiable
     * @return string
     */
    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );
    }

    /**
     * Set a callback that should be used when building the notification mail message.
     *
     * @param  \Closure  $callback
     * @return void
     */
    public static function toMailUsing($callback)
    {
        static::$toMailCallback = $callback;
    }
}
