<?php

namespace Saf\Domains\Users\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Saf\Domains\Users\User;

class ResetPassword extends Notification
{
    /**
     * The password reset link.
     *
     * @var string
     */
    public $link;

    protected $user;

    /**
     * Create a notification instance.
     *
     * @param  string  $link
     * @param  User  $user
     * @return void
     */
    public function __construct($link, User $user)
    {
        $this->link = $link;
        $this->user = $user;
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
        return (new MailMessage)
            ->view('emails.password')
            ->subject('Resetar senha')
            ->greeting('Olá ' . $this->user->name . '!')
            ->line('Clique no link para resetar sua senha:')
            ->action('Resetar sua senha', $this->link);
    }
}
