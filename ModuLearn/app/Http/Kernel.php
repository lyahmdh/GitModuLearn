<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware run during every request to your application.
     */
    protected $middleware = [
        // Trust proxies (Cloudflare, Load Balancers)
        \Illuminate\Http\Middleware\TrustProxies::class,

        // Handle CORS
        \Illuminate\Http\Middleware\HandleCors::class,

        // Prevent requests during maintenance
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,

        // Validate POST request size
        \Illuminate\Http\Middleware\ValidatePostSize::class,

        // Trim strings
        \App\Http\Middleware\TrimStrings::class,

        // Convert empty strings to null
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,

            // Required for session-based auth
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,

            // CSRF
            \App\Http\Middleware\VerifyCsrfToken::class,

            // Router
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            // API Throttle
            \Illuminate\Routing\Middleware\ThrottleRequests::class . ':api',

            // Bind route models
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These can be assigned to routes or groups.
     */
    protected $routeMiddleware = [
        // Standard Laravel middleware
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,

        // Custom middleware for ModuLearn
        'role' => \App\Http\Middleware\RoleMiddleware::class,
        'mentor.verified' => \App\Http\Middleware\EnsureMentorIsVerified::class,
    ];
}
