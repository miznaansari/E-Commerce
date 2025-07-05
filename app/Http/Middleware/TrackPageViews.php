<?php
namespace App\Http\Middleware;

use Closure;
use App\Models\PageView;
use App\Events\PageViewUpdated;

class TrackPageViews
{
    public function handle($request, Closure $next)
    {
        // // Normalize the URL (e.g., treat '/' as 'welcome')
        // $currentUrl = $request->path() === '/' ? 'welcome' : $request->path();

        // // Find or create the record for the page URL
        // $pageView = PageView::firstOrCreate(['page_url' => $currentUrl]);

        // // Increment the view count
        // $pageView->increment('views');

        // // Broadcast the updated view count
        // broadcast(new PageViewUpdated($currentUrl, $pageView->views));

        return $next($request);
    }
}
