<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $userRole = Auth::user()->roles;
        
        if ($role == 'admin' && $userRole != 1) {
            abort(403, 'Unauthorized action.');
        }

        if ($role == 'user' && $userRole != 2) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}