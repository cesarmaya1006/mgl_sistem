<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminEmpresa
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$this->permiso()) {
            return redirect('dashboard')->with('mensaje', 'No tiene permiso para entrar aquí');
        }
        return $next($request);
    }

    private function permiso()
    {
        return session()->get('rol.nombre') == 'Super Administrador' || session()->get('rol.nombre') == 'Administrador' || session()->get('rol.nombre') == 'Administrador Empresa';
    }
}
