<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VisitorCountUpdated implements ShouldBroadcast
{
    use Dispatchable, SerializesModels;

    public $route;
    public $visitorCount;

    public function __construct($route, $visitorCount)
    {
        $this->route = $route;
        $this->visitorCount = $visitorCount;
    }

    public function broadcastOn()
    {
        // Broadcasting on a channel for each route
        return new Channel('visitor-count.' . $this->route);
    }

    public function broadcastAs()
    {
        return 'updated';
    }
}
