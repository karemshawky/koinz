<?php

namespace App\Notifications\SMS;

use Illuminate\Bus\Queueable;
use App\Broadcasting\SmsChannel;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ThankYou extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        $this->onQueue('notifications');
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [SmsChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toSms($notifiable)
    {
        return [
            'from' => '19997',
            'to' => $notifiable->phone,
            'line' => 'Your book has been read. have a good day.'
        ];
    }
}
