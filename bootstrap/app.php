<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Register your admin middleware aliases
        $middleware->alias([
            'admin.guest' => \App\Http\Middleware\AdminRedirect::class,
            'admin.auth'  => \App\Http\Middleware\AdminAuthenticate::class,
        ]);

        // Global redirect logic, with exemptions for admin login routes
        $middleware->redirectTo(
            // Guests
            guests: static function ($request): ?string {
                // Exempt admin login and authenticate routes from global redirect
                if ($request->is('admin/adminlogin') || $request->is('admin/authenticate')) {
                    return null;
                }

                // Otherwise route guests to either admin login or student register
                return str_starts_with($request->path(), 'admin')
                    ? '/admin/adminlogin'
                    : '/vote/register';
            },

            // Authenticated users
            users: static function ($request): ?string {
                // Exempt admin dashboard and logout from global redirect
                if ($request->is('admin/dashboard') || $request->is('admin/logout')) {
                    return null;
                }

                // Otherwise route authenticated users to either admin dashboard or vote show
                return str_starts_with($request->path(), 'admin')
                    ? '/admin/dashboard'
                    : '/vote/show';
            }
        );
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->create();