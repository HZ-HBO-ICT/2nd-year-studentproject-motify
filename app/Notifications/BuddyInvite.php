<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Action;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

/**
 * @Class   BuddyInvite
 *
 * @Package App\Notifications
 * @author  Levi Deurloo <ldeurloo1@hz.nl>
 */
class BuddyInvite extends Notification
{
    use Queueable;

    /**
     * Vars
     */
    protected $student, $invite;

    /**
     * Create a new notification instance.
     *
     * @param \App\Models\BuddyInvite $invite
     * @param $student
     */
    public function __construct(\App\Models\BuddyInvite $invite, $student)
    {
        $this->student = $student;
        $this->invite = $invite;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('A student, his name is ' . $this->student . ' needs your help!')
            ->line('A student is trying to connect you, because he needs help. ')
            ->action('Accept invite', route('buddyInvite.accept', $this->invite->id));

    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function toArray($notifiable)
    {
        return [];
    }

}
