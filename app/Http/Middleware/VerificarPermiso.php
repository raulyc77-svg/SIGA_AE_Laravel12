<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerificarPermiso
{
    public function handle(Request $request, Closure $next, string $codigo, string $accion = 'visualizar'): Response
    {
        $usuario = $request->user();

        if (!$usuario || !$usuario->activo || !in_array($accion, ['visualizar', 'modificar'], true)) {
            abort(403, 'No tienes permiso para realizar esta operación.');
        }

        if (!$usuario->tienePermiso($codigo, $accion)) {
            abort(403, 'Tu rol no tiene autorización para esta opción de SIGA-AE.');
        }

        return $next($request);
    }
}
