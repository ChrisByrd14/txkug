<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
//use Illuminate\Contracts\Queue\ShouldQueue;
//use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;

class SlackInviteRequestNotification extends Notification
{
    protected $user;

    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
//    public function __construct(\App\Models\User $user)
//    {
//        $this->user = $user;
//    }

    public function __construct($invite)
    {
        $this->invite = $invite;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack'];
    }

    public function toSlack($notifiable)
    {
        return (new SlackMessage)
        ->success()
        ->from('TXKUG Slack Team Invite Request', ':exclamation:')
        ->to('#slack-invite-requests')
        ->attachment(function ($attachment) {
            $attachment->title('Slack Team Invite Request')
                ->fields([
                    'Name' => $this->invite->name,
                    'Email' => $this->invite->email,
                ]);
        });
    }
}
