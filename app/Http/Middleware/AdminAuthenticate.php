<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. If we’re already on the login form or processing auth, let it through.
        if ($request->is('admin/adminlogin') || $request->is('admin/authenticate')) {
            return $next($request);
        }

        // 2. Otherwise, require the admins guard
        if (! Auth::guard('admins')->check()) {
            return redirect()->route('admin.adminlogin');
        }

        return $next($request);
    }
}