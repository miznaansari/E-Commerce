<?php

namespace App\Listeners;

use App\Events\SendNotification;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Illuminate\Support\Facades\Log;

class SendFirebaseNotification
{
    /**
     * Handle the event.
     *
     * @param  SendNotification  $event
     * @return void
     */
    // public function handle(SendNotification $event)
    // {
    //     $user = $event->user;
    //     $title = $event->title;
    //     $message = $event->message;

    //     // Retrieve the FCM token for the user (ensure it's in your database)
    //     $fcmToken = $user->fcm_token;

    //     if ($fcmToken) {
    //         $messaging = app('firebase.messaging');

    //         $notification = Notification::create($title, $message);
    //         $cloudMessage = CloudMessage::withTarget('token', $fcmToken)
    //             ->withNotification($notification);

    //         try {
    //             $messaging->send($cloudMessage);
    //             Log::info("Notification sent to user: {$user->id}");
    //         } catch (\Exception $e) {
    //             Log::error("Error sending notification: " . $e->getMessage());
    //         }
    //     } else {
    //         Log::warning("No FCM token found for user: {$user->id}");
    //     }
    // }
}
