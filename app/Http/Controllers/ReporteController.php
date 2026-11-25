<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteController extends Controller
{
    // Mostrar las boletas del estudiante que inició sesión
    public function boletas()
    {
        $estudiante = DB::table('estudiantes')
            ->where('usuario_id', auth()->id())
            ->first();

        abort_unless($estudiante, 403, 'No se encontró el registro del estudiante.');

        $matriculas = DB::table('matriculas')
            ->join('cargas_lectivas', 'cargas_lectivas.id', '=', 'matriculas.carga_lectiva_id')
            ->join('unidades_didacticas', 'unidades_didacticas.id', '=', 'cargas_lectivas.unidad_didactica_id')
            ->join('semestres_lectivos', 'semestres_lectivos.id', '=', 'cargas_lectivas.semestre_lectivo_id')
            ->where('matriculas.estudiante_id', $estudiante->id)
            ->select(
                'matriculas.id as matricula_id',
                'unidades_didacticas.nombre as unidad_didactica',
                'semestres_lectivos.nombre as periodo'
            )
            ->orderByDesc('semestres_lectivos.fecha_inicio')
            ->get();

        return view('reportes.boletas', compact('matriculas'));
    }

    // Generar la boleta PDF del estudiante
    public function boleta($matricula)
    {
        $estudiante = DB::table('estudiantes')
            ->where('usuario_id', auth()->id())
            ->first();

        abort_unless($estudiante, 403, 'No se encontró el registro del estudiante.');

        $m = DB::table('matriculas')
            ->join('estudiantes', 'estudiantes.id', '=', 'matriculas.estudiante_id')
            ->join('cargas_lectivas', 'cargas_lectivas.id', '=', 'matriculas.carga_lectiva_id')
            ->join('unidades_didacticas', 'unidades_didacticas.id', '=', 'cargas_lectivas.unidad_didactica_id')
            ->join('modulos_formativos', 'modulos_formativos.id', '=', 'unidades_didacticas.modulo_formativo_id')
            ->join('programas_estudio', 'programas_estudio.id', '=', 'modulos_formativos.programa_estudio_id')
            ->join('semestres_lectivos', 'semestres_lectivos.id', '=', 'cargas_lectivas.semestre_lectivo_id')
            ->where('matriculas.id', $matricula)
            ->where('matriculas.estudiante_id', $estudiante->id)
            ->select(
                'matriculas.*',
                'estudiantes.codigo_estudiante',
                'estudiantes.apellidos',
                'estudiantes.nombres',
                'unidades_didacticas.nombre as unidad_didactica',
                'modulos_formativos.nombre as modulo',
                'programas_estudio.nombre as programa',
                'semestres_lectivos.nombre as periodo',
                'semestres_lectivos.fecha_inicio',
                'semestres_lectivos.fecha_fin'
            )
            ->first();

        abort_unless($m, 404, 'No se encontró la matrícula solicitada.');

        $notas = DB::table('calificaciones')
            ->join('criterios_evaluacion', 'criterios_evaluacion.id', '=', 'calificaciones.criterio_evaluacion_id')
            ->where('calificaciones.matricula_id', $matricula)
            ->select(
                'criterios_evaluacion.nombre',
                'criterios_evaluacion.porcentaje',
                'calificaciones.nota'
            )
            ->orderBy('criterios_evaluacion.orden')
            ->get();

        $promedio = $notas->sum(function ($nota) {
            return $nota->nota * $nota->porcentaje / 100;
        });

        $porcentajeTotal = $notas->sum('porcentaje');

        $pdf = Pdf::loadView('reportes.boleta', compact(
            'm',
            'notas',
            'promedio',
            'porcentajeTotal'
        ))->setPaper('a4', 'portrait');

        return $pdf->download('boleta-' . $m->codigo_estudiante . '.pdf');
    }

    // Generar acta consolidada
    public function acta($carga)
    {
        $rows = DB::table('matriculas')
            ->join('estudiantes', 'estudiantes.id', '=', 'matriculas.estudiante_id')
            ->leftJoin('calificaciones', 'calificaciones.matricula_id', '=', 'matriculas.id')
            ->leftJoin('criterios_evaluacion', 'criterios_evaluacion.id', '=', 'calificaciones.criterio_evaluacion_id')
            ->where('matriculas.carga_lectiva_id', $carga)
            ->select(
                'estudiantes.codigo_estudiante',
                'estudiantes.apellidos',
                'estudiantes.nombres',
                DB::raw('ROUND(SUM(calificaciones.nota * criterios_evaluacion.porcentaje / 100), 2) as promedio')
            )
            ->groupBy(
                'matriculas.id',
                'estudiantes.codigo_estudiante',
                'estudiantes.apellidos',
                'estudiantes.nombres'
            )
            ->get();

        $pdf = Pdf::loadView('reportes.acta', compact('rows', 'carga'));

        return $pdf->download('acta-consolidada-' . $carga . '.pdf');
    }
}