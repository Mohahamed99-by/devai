<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$permissions): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Vous devez être connecté pour accéder à cette page.');
        }

        $user = Auth::user();
        
        if (empty($permissions)) {
            return $next($request);
        }
        
        if ($user->hasAnyPermission($permissions)) {
            return $next($request);
        }
        
        return redirect()->route('technical-sheets.index')
            ->with('error', 'Vous n\'avez pas les permissions nécessaires pour accéder à cette page.');
    }
}
