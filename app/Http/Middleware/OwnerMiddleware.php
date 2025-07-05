<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class OwnerMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the authenticated user's role is "owner"
        if (auth()->check() && auth()->user()->role === 'owner') {
            return $next($request);
        }

        // If not an owner, redirect or deny access
        return redirect('/unauthorized')->with('error', 'Access Denied!');
    }
}
