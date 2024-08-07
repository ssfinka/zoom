<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && in_array(Auth::user()->role, ['staff', 'pembicara', 'tamu'])) {
            return $next($request);
        }
        return redirect('/login');
    }
}
