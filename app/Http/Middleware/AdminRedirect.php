<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminRedirect
{
    public function handle(Request $request, Closure $next): Response
    {
        // 1) Let the login page and authenticate action run unhindered
        if ($request->is('admin/adminlogin') || $request->is('admin/authenticate')) {
            return $next($request);
        }

        // 2) If the guard is active, redirect to dashboard
        if (Auth::guard('admins')->check()) {
            return redirect()->route('admin.dashboard');
        }

        // 3) Otherwise show the login form (or whatever’s next)
        return $next($request);
    }
}