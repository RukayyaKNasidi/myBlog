<?php

use App\Http\Middleware\AdminMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;
use Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance;
use Illuminate\Foundation\Http\Middleware\TrimStrings;
use Illuminate\Foundation\Http\Middleware\ValidatePostSize;
use Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets;
use Illuminate\Http\Middleware\DispatchServingCallbacks;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Http\Middleware\TrustProxies;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Routing\Middleware\VerifyCsrfToken;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias(['admin' => \App\Http\Middleware\AdminMiddleware::class]); // Corrected line
        $middleware->web(AppendQueuedCookiesToResponse::class);
        $middleware->web(EncryptCookies::class);
        $middleware->web(VerifyCsrfToken::class);
        $middleware->web(AddLinkHeadersForPreloadedAssets::class);
        $middleware->web(DispatchServingCallbacks::class);
        $middleware->web(SubstituteBindings::class);
        $middleware->web(ShareErrorsFromSession::class);
        $middleware->web(StartSession::class);
        $middleware->web(TrimStrings::class);
        $middleware->web(TrustProxies::class);
        $middleware->web(ValidatePostSize::class);
        $middleware->web(PreventRequestsDuringMaintenance::class);
        $middleware->web(ConvertEmptyStringsToNull::class);
    })
    
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
