<?php
namespace App\Http\Middleware;
use Closure; use Illuminate\Http\Request;
class VerificarRol {
 public function handle(Request $request, Closure $next, ...$roles) {
  $u=$request->user();
  if(!$u || !$u->activo || !$u->roles()->whereIn('nombre',$roles)->exists()) abort(403,'No tienes permiso para acceder a esta sección.');
  return $next($request);
 }
}
