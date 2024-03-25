<?php

namespace App\Broadcasting;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use Illuminate\Notifications\Notification;

class SmsChannel
{
    /**
     * Send the given notification.
     */
    public function send(object $notifiable, Notification $notification): void
    {
        $message = $notification->toSms($notifiable);

        // Send notification to the $notifiable instance...

        $client_url = App::environment('production') == true ? env('FIRST_SMS_PROVIDER_URL') : env('SECOND_SMS_PROVIDER_URL');

        $response = Http::acceptJson()->post($client_url, [
            'message' => $message['line'],
            'phone' => $message['to'],
        ]);
    }
}
