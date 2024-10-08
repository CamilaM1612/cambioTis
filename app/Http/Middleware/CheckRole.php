<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirigir a la página de login si no está autenticado
        }

        // Verificar si el usuario tiene el rol requerido
        $userRole = Auth::user()->role; // Asegúrate de que esto sea correcto

        if (!$userRole || $userRole->name !== $role) {
            return redirect('/')->with('error', 'No tienes acceso a esta página.');
        }

        return $next($request);
    }
}
