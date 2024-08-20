<?php

use App\Models\Client;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Laravel\Sanctum\Http\Middleware\CheckAbilities;
use Laravel\Sanctum\Http\Middleware\CheckForAnyAbility;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up'
    )
    ->withMiddleware(function (Middleware $middleware) {
         $middlewareGroups = [
            'web' =>

                \App\Http\Middleware\AutoCheckPermission::class,

        ];


    })
    ->withExceptions(function (Exceptions $exceptions) {

    })->Create();
      class Handler extends ExceptionHandler
         {
             protected function unauthenticated($request, AuthenticationException $exception): \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
              {
            // api/v1/blood-types
            return $request->is('api/*')
                ? responseJson(0, 'Unauthenticated.')
                : redirect()->guest($exception->redirectTo() ?? route('login'));

            }

          public function handle($request, Closure $next)
          {
              $token = $request->header('Authorization');
              if (!$token) {
                  return response()->json(['error' => 'Unauthorized'], 401);
              }

              $client = Client::where('api_token', $token)->first();
              if (!$client) {
                  return response()->json(['error' => 'Unauthorized'], 401);
              }

              return $next($request);
          }
         }



