<?php
namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\Request;
use App\Models\RouteVisit;
use App\Events\RouteVisitUpdated;
use Illuminate\Support\Facades\DB;
use App\Models\Customerdetail;

class TrackRouteVisits
{
    public function handle($request, Closure $next)
    {
        // Get the current path
        $routePath = $request->path();
    
        // // Save the root path as "/"
        if ($routePath === '/') {
            $routePath = '/';
        }
    
        // Update or create the route visit record
        $routeVisit = RouteVisit::updateOrCreate(
            ['route' => $routePath],
            ['count' => DB::raw('count + 1')]
        );
    
        // Dispatch the event after updating or creating the record
        // event(new RouteVisitUpdated($routeVisit));

        return $next($request);
    }
}
