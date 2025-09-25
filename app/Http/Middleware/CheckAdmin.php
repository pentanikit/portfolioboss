<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors('Please log in.');
        }
        if (!Auth::user()) {
            abort(403, 'Admins only.');
        }
        return $next($request);
    }
}
