<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifierRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
{
    // Si l'utilisateur n'est pas connecté ou n'a pas le bon rôle
    if (!$request->user() || $request->user()->role !== $role) {
        // On le redirige vers le dashboard avec un message d'erreur
        return redirect('/dashboard')->with('error', 'Accès interdit !');
    }

    return $next($request);
}
}
