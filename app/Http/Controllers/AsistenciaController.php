<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request; use Illuminate\Support\Facades\DB;
use App\Models\SesionClase; use App\Models\Matricula; use App\Models\Asistencia;
class AsistenciaController extends Controller {
 public function index(){ $sesiones=SesionClase::with('relacion')->latest('fecha')->paginate(15); return view('asistencias.index',compact('sesiones')); }
 public function create(){ $cargas=DB::table('cargas_lectivas')->join('unidades_didacticas','unidades_didacticas.id','=','cargas_lectivas.unidad_didactica_id')->select('cargas_lectivas.id','unidades_didacticas.nombre')->where('cargas_lectivas.estado','activo')->get(); return view('asistencias.create',compact('cargas')); }
 public function store(Request $r){
  $d=$r->validate(['carga_lectiva_id'=>'required|exists:cargas_lectivas,id','fecha'=>'required|date','nro_sesion'=>'required|integer|min:1','tema_desarrollado'=>'nullable|string|max:200','horas_dictadas'=>'required|numeric|min:0.5|max:12']);
  $sesion=DB::transaction(function()use($d){$s=SesionClase::create($d);$matriculas=Matricula::where('carga_lectiva_id',$d['carga_lectiva_id'])->where('estado','activo')->get();foreach($matriculas as $m)Asistencia::create(['sesion_clase_id'=>$s->id,'matricula_id'=>$m->id,'estado'=>'FI']);return $s;});
  return redirect()->route('asistencias.tomar',$sesion->id)->with('ok','Sesión creada. Marca la asistencia de los estudiantes.');
 }
 public function tomar($id){$sesion=SesionClase::findOrFail($id);$lista=DB::table('matriculas')->join('estudiantes','estudiantes.id','=','matriculas.estudiante_id')->join('asistencias','asistencias.matricula_id','=','matriculas.id')->where('asistencias.sesion_clase_id',$id)->select('matriculas.id as matricula_id','estudiantes.codigo_estudiante','estudiantes.apellidos','estudiantes.nombres','asistencias.id as asistencia_id','asistencias.estado','asistencias.observacion')->orderBy('estudiantes.apellidos')->get();return view('asistencias.tomar',compact('sesion','lista'));}
 public function guardar(Request $r,$id){$d=$r->validate(['asistencias'=>'required|array','asistencias.*.estado'=>'required|in:P,T,FI,FJ','asistencias.*.observacion'=>'nullable|string|max:200']);DB::transaction(function()use($d){foreach($d['asistencias'] as $aid=>$dato)Asistencia::where('id',$aid)->update(['estado'=>$dato['estado'],'observacion'=>$dato['observacion']??null]);});return back()->with('ok','Asistencia guardada correctamente.');}
 public function resumen(){ $rows=DB::table('estudiantes')->join('matriculas','matriculas.estudiante_id','=','estudiantes.id')->join('asistencias','asistencias.matricula_id','=','matriculas.id')->select('estudiantes.codigo_estudiante','estudiantes.apellidos','estudiantes.nombres',DB::raw("SUM(CASE WHEN asistencias.estado IN ('FI','FJ') THEN 1 ELSE 0 END) as faltas"),DB::raw("COUNT(asistencias.id) as sesiones"),DB::raw("ROUND(100*SUM(CASE WHEN asistencias.estado='FI' THEN 1 ELSE 0 END)/NULLIF(COUNT(asistencias.id),0),2) as porcentaje_fi"))->groupBy('estudiantes.id','estudiantes.codigo_estudiante','estudiantes.apellidos','estudiantes.nombres')->paginate(30);return view('asistencias.resumen',compact('rows'));}
}
