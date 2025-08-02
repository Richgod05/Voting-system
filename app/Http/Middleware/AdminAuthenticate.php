<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // 1. If the user is already logged in as an admin,
        //    let them through (including hitting login if they want to log out later).
        if (Auth::guard('admins')->check()) {
            return $next($request);
        }

        // 2. If this is the login form or processing credentials, allow it.
        //    Using route names ensures you won’t accidentally block or mis-route.
        if ($request->routeIs('admin.adminlogin') ||
            $request->routeIs('admin.authenticate')) {
            return $next($request);
        }

        // 3. Otherwise, redirect any non-authenticated request to the login page.
        return redirect()->route('admin.adminlogin');
    }
}