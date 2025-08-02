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
        // 1. Register your admin middleware aliases
        $middleware->alias([
            'admin.guest' => \App\Http\Middleware\AdminRedirect::class,
            'admin.auth'  => \App\Http\Middleware\AdminAuthenticate::class,
        ]);

        // 2. Global redirect logic ONLY for “vote” (student) routes
        $middleware->redirectTo(
            // Guests → force to /vote/register when they hit any vote URI
            guests: static function ($request): ?string {
                if (str_starts_with($request->path(), 'vote')) {
                    // Allow the register page itself
                    return $request->is('vote/register')
                        ? null
                        : '/vote/register';
                }
                // No redirect for non-vote (including admin) URIs
                return null;
            },

            // Authenticated users → force to /vote/show when they hit any vote URI
            users: static function ($request): ?string {
                if (str_starts_with($request->path(), 'vote')) {
                    // Allow the show page itself
                    return $request->is('vote/show')
                        ? null
                        : '/vote/show';
                }
                // No redirect for non-vote (including admin) URIs
                return null;
            }
        );
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // ...
    })
    ->create();