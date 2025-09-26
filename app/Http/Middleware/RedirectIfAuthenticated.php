<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        // If users table doesn't exist (migrations not run), skip auth checks to avoid QueryExceptions
        if (Schema::hasTable('users')) {
            foreach ($guards as $guard) {
                if (Auth::guard($guard)->check()) {
                    return redirect('/');
                }
            }
        }

        return $next($request);
    }
}
