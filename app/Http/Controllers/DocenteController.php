<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Docente;
use App\Models\Usuario;
use Illuminate\Validation\Rule;

class DocenteController extends Controller
{
    public function index()
    {
        $docentes = Docente::orderBy('apellidos')->paginate(20);

        return view('docentes.index', compact('docentes'));
    }

    public function create()
    {
        $usuarios = Usuario::where('activo', true)
            ->whereDoesntHave('docente')
            ->orderBy('username')
            ->get();

        return view('docentes.form', [
            'docente' => null,
            'usuarios' => $usuarios
        ]);
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'usuario_id' => [
                'required',
                'exists:usuarios,id',
                Rule::unique('docentes', 'usuario_id')
            ],
            'codigo_docente' => 'required|max:30|unique:docentes,codigo_docente',
            'apellidos' => 'required|max:100',
            'nombres' => 'required|max:100',
            'especialidad' => 'nullable|max:120',
            'telefono' => 'nullable|max:25'
        ]);

        Docente::create($datos + ['estado' => true]);

        return redirect()->route('docentes.index')
            ->with('ok', 'Docente registrado correctamente.');
    }

    public function edit($id)
    {
        $docente = Docente::findOrFail($id);

        return view('docentes.form', [
            'docente' => $docente,
            'usuarios' => collect()
        ]);
    }

    public function update(Request $request, $id)
    {
        $docente = Docente::findOrFail($id);

        $datos = $request->validate([
            'codigo_docente' => [
                'required',
                'max:30',
                Rule::unique('docentes', 'codigo_docente')->ignore($docente->id)
            ],
            'apellidos' => 'required|max:100',
            'nombres' => 'required|max:100',
            'especialidad' => 'nullable|max:120',
            'telefono' => 'nullable|max:25'
        ]);

        $docente->update($datos);

        return redirect()->route('docentes.index')
            ->with('ok', 'Datos del docente actualizados.');
    }

    public function destroy($id)
    {
        Docente::findOrFail($id)->update(['estado' => false]);

        return redirect()->route('docentes.index')
            ->with('ok', 'Docente desactivado.');
    }
}
