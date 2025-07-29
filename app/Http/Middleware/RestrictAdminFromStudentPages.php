<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RestrictAdminFromStudentPages
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    

    public function handle($request, Closure $next)
        {
                $student = Auth::guard('students')->user();

                if ($student && $student->role === 'admin') {
                    // Option 1: redirect to admin page
                    return redirect()->route('admin.dashboard')->with('error', 'Admins cannot access student pages.');

                    // Option 2: abort completely
                    // abort(403, 'Access denied.');
                }

            return $next($request);
        }
}

