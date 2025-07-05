<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SendNotification
{
    use Dispatchable, SerializesModels;

    // public $user;
    // public $title;
    // public $message;

    // /**
    //  * Create a new event instance.
    //  *
    //  * @param $user
    //  * @param $title
    //  * @param $message
    //  */
    // public function __construct($user, $title, $message)
    // {
    //     $this->user = $user;
    //     $this->title = $title;
    //     $this->message = $message;
    // }
}
