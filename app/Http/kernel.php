<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Auth\Middleware\Authenticate ;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Auth\Middleware\AuthenticateWithBasicAuth;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;
use Illuminate\Routing\Middleware\SubstituteBindings; // Ajouté pour l'optimisation
use Illuminate\Routing\Middleware\ThrottleRequests; // Ajouté pour l'optimisation
use Illuminate\Routing\Middleware\ValidateSignature; // Ajouté pour l'optimisation
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse; // Ajouté pour l'optimisation
use Illuminate\Session\Middleware\StartSession; // Ajouté pour l'optimisation
use Illuminate\Session\Middleware\AuthenticateSession; // Ajouté pour l'optimisation
use Illuminate\View\Middleware\ShareErrorsFromSession; // Ajouté pour l'optimisation
use Illuminate\Foundation\Http\Middleware\ValidatePostSize; // Ajouté pour l'optimisation
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull; // Ajouté pour l'optimisation
use Illuminate\Http\Middleware\SetCacheHeaders; // Ajouté pour l'optimisation
use Illuminate\Auth\Middleware\Authorize; // Ajouté pour l'optimisation
use Illuminate\Auth\Middleware\RequirePassword; // Ajouté pour l'optimisation
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful; // Déjà présent, mais confirmé

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        // TrustProxies::class, // Optimisé
        // HandleCors::class, // Optimisé
        // PreventRequestsDuringMaintenance::class, // Optimisé
        ValidatePostSize::class, // Optimisé
        // TrimStrings::class, // Optimisé
        ConvertEmptyStringsToNull::class, // Optimisé
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            // EncryptCookies::class, // Optimisé
            AddQueuedCookiesToResponse::class, // Optimisé
            StartSession::class, // Optimisé
            AuthenticateSession::class, // Optimisé
            ShareErrorsFromSession::class, // Optimisé
            // VerifyCsrfToken::class, // Optimisé
            SubstituteBindings::class, // Optimisé
        ],

        'api' => [
            EnsureFrontendRequestsAreStateful::class,
            'throttle:api',
            SubstituteBindings::class, // Optimisé
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => Authenticate::class, // Optimisé
        'auth.basic' => AuthenticateWithBasicAuth::class, // Optimisé
        'cache.headers' => SetCacheHeaders::class, // Optimisé
        'can' => Authorize::class, // Optimisé
        'guest' => RedirectIfAuthenticated::class, // Optimisé
        'password.confirm' => RequirePassword::class, // Optimisé
        'signed' => ValidateSignature::class, // Optimisé
        'throttle' => ThrottleRequests::class, // Optimisé
        'verified' => EnsureEmailIsVerified::class, // Optimisé
    ];
}