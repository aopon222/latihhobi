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
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Check if user is authenticated
        if (!$request->user()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthenticated'
            ], 401);
        }
        
        // Check if user has any of the required roles
        if (!empty($roles) && !$request->user()->hasAnyRole($roles)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Insufficient permissions'
            ], 403);
        }

        if (!$request->user() || $request->user()->role !== $role) {
            return response()->json([
                'message' => 'Akses ditolak. Anda tidak memiliki permission.'
            ], 403);
        }

        return $next($request);
    }
}
