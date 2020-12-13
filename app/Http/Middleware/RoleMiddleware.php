<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role_id == '1' || Auth::user()->role_id == '4')
        {
            return redirect('/admin/dashboard');
        }
        return redirect('/');
    }
}
