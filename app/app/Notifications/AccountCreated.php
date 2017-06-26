<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\SlackMessage;

class AccountCreated extends Notification
{
    use Queueable;

    private $guest;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(\App\Guest $guest)
    {
        $this->guest = $guest;
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
                    ->from(config('app.name'))
                    ->success()
                    ->content('A new account has been created!')
                    ->attachment(function ($attachment) {
                        $attachment->title($this->guest->cn)
                                   ->fields([
                                        'Sponsor' => $this->guest->sponsor->name,
                                        'Duration' => date("F j, Y", ($this->guest->expiration)),
                                        'Location' => $this->guest->location,
                                        'Purpose' => $this->guest->purpose,
                                        'Username' => $this->guest->username,
                                        'Password' => $this->guest->password,
                                    ]);
                    });
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
            //
        ];
    }
}
