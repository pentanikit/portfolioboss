<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CountVisit
{
    public function handle(Request $request, Closure $next)
    {
        // Count only once per browser session, only for GET page loads
        if ($request->isMethod('get') && ! $request->ajax() && ! session()->has('site_visit_counted')) {
            // Ensure the counter key exists, then atomically increment
            Cache::add('site_visits_total', 0);
            Cache::increment('site_visits_total');
            session()->put('site_visit_counted', now()->toDateTimeString());
        }

        return $next($request);
    }
}
