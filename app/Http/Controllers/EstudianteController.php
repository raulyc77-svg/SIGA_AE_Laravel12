<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;use App\Models\Estudiante;
class EstudianteController extends Controller {
 public function index(){ $estudiantes=Estudiante::orderBy('apellidos')->paginate(20);return view('estudiantes.index',compact('estudiantes')); }
 public function create(){return view('estudiantes.form',['estudiante'=>null]);}
 public function store(Request $r){$d=$r->validate(['usuario_id'=>'required|exists:usuarios,id','codigo_estudiante'=>'required|unique:estudiantes,codigo_estudiante','apellidos'=>'required|max:100','nombres'=>'required|max:100','documento'=>'required|unique:estudiantes,documento','telefono'=>'nullable|max:25']);Estudiante::create($d+['estado'=>true]);return redirect()->route('estudiantes.index')->with('ok','Estudiante registrado.');}
 public function edit($id){return view('estudiantes.form',['estudiante'=>Estudiante::findOrFail($id)]);}
 public function update(Request $r,$id){$e=Estudiante::findOrFail($id);$d=$r->validate(['codigo_estudiante'=>'required|unique:estudiantes,codigo_estudiante,'.$id,'apellidos'=>'required|max:100','nombres'=>'required|max:100','documento'=>'required|unique:estudiantes,documento,'.$id,'telefono'=>'nullable|max:25']);$e->update($d);return back()->with('ok','Datos actualizados.');}
 public function destroy($id){Estudiante::findOrFail($id)->update(['estado'=>false]);return back()->with('ok','Estudiante desactivado.');}
}
