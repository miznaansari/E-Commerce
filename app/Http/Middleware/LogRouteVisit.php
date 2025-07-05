<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\RouteVisit;
use App\Events\RouteVisitUpdated;

class LogRouteVisit
{
    public function handle($request, Closure $next)
    {
        $route = $request->path();
        $routeVisit = RouteVisit::firstOrCreate(['route' => $route]);
        $routeVisit->increment('count');

        // Broadcast route visit count
        event(new RouteVisitUpdated($route, $routeVisit->count));

        return $next($request);
    }
}
