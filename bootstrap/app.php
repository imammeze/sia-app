<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Filament\Notifications\Notification;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->trustProxies(at: '*');
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (QueryException $e, Request $request) {
            // Error code 23000 indicates a foreign key constraint violation
            if ($e->getCode() == "23000") {
                if (class_exists(Notification::class)) {
                    Notification::make()
                        ->danger()
                        ->title('Gagal Menghapus Data')
                        ->body('Data ini tidak bisa dihapus karena masih memiliki relasi dengan data lain.')
                        ->send();
                }
                
                return back()->with('error', 'Data gagal dihapus.');
            }
        });
    })->create();