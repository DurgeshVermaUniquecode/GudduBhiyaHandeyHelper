<?php

use App\Http\Middleware\AdminAuth;
use App\Http\Middleware\VendorAuth;
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

        $middleware->alias([
            'admin' => AdminAuth::class,
            'vendor' => VendorAuth::class

        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {

        $exceptions->render(function (\Illuminate\Auth\AuthenticationException $e, \Illuminate\Http\Request $request) {


            if ($request->is('admin') || $request->is('admin/*')) {

                return redirect()->route('admin.login');
            }

            // If accessing vendor routes
            if ($request->is('vendor') || $request->is('vendor/*')) {
                return redirect()->route('vendor.login');
            }

            // Default fallback (if you add frontend login later)
            return redirect()->route('login');
        });
    })->create();
