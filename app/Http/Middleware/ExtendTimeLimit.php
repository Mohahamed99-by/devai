<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ExtendTimeLimit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, int $timeLimit = 120): Response
    {
        // Sauvegarder la limite actuelle
        $originalTimeLimit = ini_get('max_execution_time');
        
        // Définir la nouvelle limite
        set_time_limit($timeLimit);
        
        try {
            $response = $next($request);
        } finally {
            // Restaurer la limite originale
            if ($originalTimeLimit !== false) {
                set_time_limit((int) $originalTimeLimit);
            }
        }
        
        return $response;
    }
}
