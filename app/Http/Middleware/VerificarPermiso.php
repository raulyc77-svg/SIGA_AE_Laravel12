<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerificarPermiso
{
    public function handle(
        Request $request,
        Closure $next,
        string $codigo,
        string $accion = 'visualizar'
    ): Response {
        $usuario = $request->user();

        if (!$usuario) {
            abort(403, 'DIAGNOSTICO: No hay usuario autenticado.');
        }

        if (!$usuario->activo) {
            abort(403, 'DIAGNOSTICO: Usuario desactivado.');
        }

        if (!in_array($accion, ['visualizar', 'modificar'], true)) {
            abort(403, 'DIAGNOSTICO: Acción no válida.');
        }

        if (!$usuario->tienePermiso($codigo, $accion)) {
            abort(403, 'DIAGNOSTICO: Usuario=' . $usuario->username .
                ' | ID=' . $usuario->id .
                ' | Código=' . $codigo .
                ' | Acción=' . $accion);
        }

        return $next($request);
    }
}
