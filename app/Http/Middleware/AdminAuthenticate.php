<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthenticate
{
    public function handle(Request $request, Closure $next)
    {
        // If logged in as admin, allow access to admin routes
        if (Auth::guard('admins')->check()) {
            return $next($request);
        }

        // Otherwise redirect back to admin login
        return redirect()->route('admin.adminlogin');
    }
}