<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Usage: Route::middleware('role:admin')  or  Route::middleware('role:admin,teacher')
 * Register the 'role' alias in bootstrap/app.php (see snippet provided separately).
 */
class EnsureUserHasRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        abort_if(! $user, 401);
        abort_unless($user->hasAnyRole($roles), 403, 'You do not have permission to perform this action.');

        return $next($request);
    }
}
