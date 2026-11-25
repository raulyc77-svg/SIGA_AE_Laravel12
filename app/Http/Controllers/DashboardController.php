<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller {
 public function index(){
  return view('dashboard',['estudiantes'=>DB::table('estudiantes')->where('estado',1)->count(),'docentes'=>DB::table('docentes')->where('estado',1)->count(),'cargas'=>DB::table('cargas_lectivas')->where('estado','activo')->count(),'sesiones'=>DB::table('sesiones_clase')->count(),'asistencias'=>DB::table('asistencias')->count()]);
 }
}
