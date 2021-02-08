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
class BuddyInviteAccepted extends Notification
{
    use Queueable;

    /**
     * Vars
     */
    protected $invite;

    /**
     * Create a new notification instance.
     *
     * @param \App\Models\BuddyInvite $invite
     * @param $student
     */
    public function __construct(\App\Models\BuddyInvite $invite)
    {
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
            ->subject("In Room Support is on his way")
            ->line($this->invite->requestedUser->name . ' has accepted your request and is heading to your room.');
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
