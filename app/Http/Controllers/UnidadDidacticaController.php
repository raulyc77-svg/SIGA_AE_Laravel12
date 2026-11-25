<?php

namespace App\Http\Controllers;

use App\Models\ModuloFormativo;
use App\Models\UnidadDidactica;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UnidadDidacticaController extends Controller
{
    public function index(Request $request)
    {
        $consulta = UnidadDidactica::with('modulo.programa')
            ->orderBy('nombre');

        if ($request->filled('buscar')) {
            $buscar = trim($request->string('buscar')->toString());
            $consulta->where('nombre', 'like', "%{$buscar}%");
        }

        if ($request->filled('estado') && in_array($request->estado, ['0', '1'], true)) {
            $consulta->where('estado', (int) $request->estado);
        }

        $unidades = $consulta->paginate(15)->withQueryString();

        return view('unidades_didacticas.index', compact('unidades'));
    }

    public function create()
    {
        $modulos = ModuloFormativo::with('programa')
            ->where('estado', true)->orderBy('nombre')->get();

        return view('unidades_didacticas.form', [
            'unidad' => new UnidadDidactica(),
            'modulos' => $modulos,
        ]);
    }

    public function store(Request $request)
    {
        $datos = $this->validar($request);
        $datos['estado'] = $request->boolean('estado');
        UnidadDidactica::create($datos);

        return redirect()->route('unidades-didacticas.index')
            ->with('ok', 'Unidad didáctica registrada correctamente.');
    }

    public function edit(UnidadDidactica $unidad_didactica)
    {
        $modulos = ModuloFormativo::with('programa')->orderBy('nombre')->get();

        return view('unidades_didacticas.form', [
            'unidad' => $unidad_didactica,
            'modulos' => $modulos,
        ]);
    }

    public function update(Request $request, UnidadDidactica $unidad_didactica)
    {
        $datos = $this->validar($request);
        $datos['estado'] = $request->boolean('estado');
        $unidad_didactica->update($datos);

        return redirect()->route('unidades-didacticas.index')
            ->with('ok', 'Unidad didáctica actualizada correctamente.');
    }

    public function destroy(UnidadDidactica $unidad_didactica)
    {
        // Se desactiva para conservar el historial académico y las relaciones existentes.
        $unidad_didactica->update(['estado' => false]);

        return redirect()->route('unidades-didacticas.index')
            ->with('ok', 'Unidad didáctica desactivada. No se eliminó de la base de datos.');
    }

    private function validar(Request $request): array
    {
        return $request->validate([
            'modulo_formativo_id' => ['required', 'integer', 'exists:modulos_formativos,id'],
            'nombre' => ['required', 'string', 'max:150'],
            'horas_totales' => ['required', 'integer', 'min:0', 'max:65535'],
            'creditos' => ['required', 'integer', 'min:0', 'max:65535'],
        ]);
    }
}
