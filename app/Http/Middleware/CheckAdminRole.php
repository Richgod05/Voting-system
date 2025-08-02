<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckAdminRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $admin = Auth::guard('admins')->user();

        if (!$admin || $admin->role !== 'admin') {
            return redirect()->route('admin.adminlogin')
                ->with('error', 'Access denied: Admins only.');
        }

        return $next($request);
    }
}