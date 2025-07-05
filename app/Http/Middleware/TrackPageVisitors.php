<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\VisitorCount;
use App\Events\VisitorCountUpdated;

class TrackPageVisitors
{
    public function handle($request, Closure $next)
    {
        // Get the current route (e.g., '/' or '/product')
        $route = $request->path();

        // Find or create a record for the current route
        // $visitorCount = VisitorCount::firstOrCreate(
        //     ['route' => $route],
        //     ['count' => 0] // Default count to 0 if not found
        // );

        // Increment the count by 1
        // $visitorCount->increment('count');

        // Broadcast the updated visitor count to Pusher
        // event(new VisitorCountUpdated($route, $visitorCount->count));

        return $next($request);
    }
}
