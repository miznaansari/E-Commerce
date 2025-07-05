<?php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Models\RouteVisit;
class RouteVisitUpdated implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $routeVisit;

    public function __construct(RouteVisit $routeVisit)
    {
        $this->routeVisit = $routeVisit;
    }

    public function broadcastOn()
    {
        return new Channel('route-visits'); // Channel name
    }

    public function broadcastAs()
    {
        return 'RouteVisitUpdated'; // Event name
    }
}
