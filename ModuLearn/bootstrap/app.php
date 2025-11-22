<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsMentor;
use App\Http\Middleware\IsMentee;
use App\Http\Middleware\HasVerifiedMentor;
use App\Http\Middleware\GuestAccess;

use Illuminate\Auth\Middleware\AuthenticateWithBasicAuth;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;
use Illuminate\Http\Middleware\HandleCors;
use Illuminate\Http\Middleware\TrustProxies;
use App\Http\Middleware\PreventRequestsDuringMaintenance;
use Illuminate\Foundation\Http\Middleware\ValidatePostSize;
use App\Http\Middleware\TrimStrings;
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;
use Illuminate\Routing\Middleware\ThrottleRequests;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {

        // --- GLOBAL MIDDLEWARE ---
        $middleware->use([
            \Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests::class,
            \Illuminate\Http\Middleware\HandleCors::class,
            \Illuminate\Http\Middleware\TrustProxies::class,
            \Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance::class,
            \Illuminate\Http\Middleware\ValidatePostSize::class,
            \Illuminate\Foundation\Http\Middleware\TrimStrings::class,
            \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        ]);

        // --- MIDDLEWARE ALIASES ---
        $middleware->alias([
            'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
            'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
            'guest' => \Illuminate\Auth\Middleware\RedirectIfAuthenticated::class,
            'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        
            'is_admin' => \App\Http\Middleware\IsAdmin::class,
            'is_mentor' => \App\Http\Middleware\IsMentor::class,
            'is_mentee' => \App\Http\Middleware\IsMentee::class,
            'verified_mentor' => \App\Http\Middleware\HasVerifiedMentor::class,
            'guest_access' => \App\Http\Middleware\GuestAccess::class,
        ]);
        

        // --- MIDDLEWARE GROUPS ---
        $middleware->group('web', [
            \Illuminate\Cookie\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ]);

        $middleware->group('api', [
            ThrottleRequests::class . ':api',
            SubstituteBindings::class,
        ]);

        // --- OPTIONAL: PRIORITY (jika perlu) ---
        $middleware->priority([
            HandlePrecognitiveRequests::class,
            EncryptCookies::class,
            AddQueuedCookiesToResponse::class,
            StartSession::class,
            AuthenticateSession::class,
            SubstituteBindings::class,
            VerifyCsrfToken::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->create();
