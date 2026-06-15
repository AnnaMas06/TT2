<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle($request, \Closure $next, ...$roles)
    {
        if (!auth()->check()) {
            abort(403);
        }

        if (!auth()->user()->role || !in_array(auth()->user()->role->name, $roles)) {
            abort(403);
        }

        return $next($request);
    }
}
