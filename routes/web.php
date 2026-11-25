
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\EvaluacionController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\UnidadDidacticaController;

Route::get('/', fn () => redirect()->route('login'));

Route::get('/login', [AuthController::class, 'form'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::middleware('auth')->group(function () {

    // AUTENTICACIÓN Y PERFIL
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/perfil/clave', [AuthController::class, 'passwordForm'])
        ->name('perfil.password');

    Route::put('/perfil/clave', [AuthController::class, 'passwordUpdate'])
        ->name('perfil.password.update');

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');


    // O11 - ESTUDIANTES
    Route::get('/estudiantes', [EstudianteController::class, 'index'])
        ->middleware('permiso:O11,visualizar')
        ->name('estudiantes.index');

    Route::get('/estudiantes/crear', [EstudianteController::class, 'create'])
        ->middleware('permiso:O11,modificar')
        ->name('estudiantes.create');

    Route::post('/estudiantes', [EstudianteController::class, 'store'])
        ->middleware('permiso:O11,modificar')
        ->name('estudiantes.store');

    Route::get('/estudiantes/{estudiante}/editar', [EstudianteController::class, 'edit'])
        ->middleware('permiso:O11,modificar')
        ->name('estudiantes.edit');

    Route::put('/estudiantes/{estudiante}', [EstudianteController::class, 'update'])
        ->middleware('permiso:O11,modificar')
        ->name('estudiantes.update');

    Route::patch('/estudiantes/{estudiante}', [EstudianteController::class, 'update'])
        ->middleware('permiso:O11,modificar');

    Route::delete('/estudiantes/{estudiante}', [EstudianteController::class, 'destroy'])
        ->middleware('permiso:O11,modificar')
        ->name('estudiantes.destroy');


    // O12 - DOCENTES
    Route::get('/docentes', [DocenteController::class, 'index'])
        ->middleware('permiso:O12,visualizar')
        ->name('docentes.index');

    Route::get('/docentes/crear', [DocenteController::class, 'create'])
        ->middleware('permiso:O12,modificar')
        ->name('docentes.create');

    Route::post('/docentes', [DocenteController::class, 'store'])
        ->middleware('permiso:O12,modificar')
        ->name('docentes.store');

    Route::get('/docentes/{docente}/editar', [DocenteController::class, 'edit'])
        ->middleware('permiso:O12,modificar')
        ->name('docentes.edit');

    Route::put('/docentes/{docente}', [DocenteController::class, 'update'])
        ->middleware('permiso:O12,modificar')
        ->name('docentes.update');

    Route::delete('/docentes/{docente}', [DocenteController::class, 'destroy'])
        ->middleware('permiso:O12,modificar')
        ->name('docentes.destroy');


    // O15 - ITINERARIOS / UNIDADES DIDÁCTICAS
    Route::get('/unidades-didacticas', [UnidadDidacticaController::class, 'index'])
        ->middleware('permiso:O15,visualizar')
        ->name('unidades-didacticas.index');

    Route::get('/unidades-didacticas/crear', [UnidadDidacticaController::class, 'create'])
        ->middleware('permiso:O15,modificar')
        ->name('unidades-didacticas.create');

    Route::post('/unidades-didacticas', [UnidadDidacticaController::class, 'store'])
        ->middleware('permiso:O15,modificar')
        ->name('unidades-didacticas.store');

    Route::get('/unidades-didacticas/{unidad_didactica}/editar', [UnidadDidacticaController::class, 'edit'])
        ->middleware('permiso:O15,modificar')
        ->name('unidades-didacticas.edit');

    Route::put('/unidades-didacticas/{unidad_didactica}', [UnidadDidacticaController::class, 'update'])
        ->middleware('permiso:O15,modificar')
        ->name('unidades-didacticas.update');

    Route::patch('/unidades-didacticas/{unidad_didactica}', [UnidadDidacticaController::class, 'update'])
        ->middleware('permiso:O15,modificar');

    Route::delete('/unidades-didacticas/{unidad_didactica}', [UnidadDidacticaController::class, 'destroy'])
        ->middleware('permiso:O15,modificar')
        ->name('unidades-didacticas.destroy');


    // O32 - CONSULTA DE ASISTENCIA
    // O25 - REGISTRO DE ASISTENCIA
    Route::get('/asistencias', [AsistenciaController::class, 'index'])
        ->middleware('permiso:O32,visualizar')
        ->name('asistencias.index');

    Route::get('/asistencias/resumen', [AsistenciaController::class, 'resumen'])
        ->middleware('permiso:O32,visualizar')
        ->name('asistencias.resumen');

    Route::get('/asistencias/crear', [AsistenciaController::class, 'create'])
        ->middleware('permiso:O25,modificar')
        ->name('asistencias.create');

    Route::post('/asistencias', [AsistenciaController::class, 'store'])
        ->middleware('permiso:O25,modificar')
        ->name('asistencias.store');

    Route::get('/asistencias/{id}/tomar', [AsistenciaController::class, 'tomar'])
        ->middleware('permiso:O25,modificar')
        ->name('asistencias.tomar');

    Route::put('/asistencias/{id}', [AsistenciaController::class, 'guardar'])
        ->middleware('permiso:O25,modificar')
        ->name('asistencias.guardar');


    // O23 - INDICADORES
    Route::get('/evaluaciones/criterios', [EvaluacionController::class, 'criterios'])
        ->middleware('permiso:O23,modificar')
        ->name('evaluaciones.criterios');

    Route::post('/evaluaciones/criterios', [EvaluacionController::class, 'guardarCriterio'])
        ->middleware('permiso:O23,modificar')
        ->name('evaluaciones.criterios.store');


    // O24 / O33 - EVALUACIONES Y REGISTRO DE NOTAS
    Route::get('/evaluaciones', [EvaluacionController::class, 'index'])
        ->middleware('permiso:O33,modificar')
        ->name('evaluaciones.index');

    Route::get('/evaluaciones/matriz', [EvaluacionController::class, 'matriz'])
        ->middleware('permiso:O33,modificar')
        ->name('evaluaciones.matriz');

    Route::post('/evaluaciones/notas', [EvaluacionController::class, 'guardarNotas'])
        ->middleware('permiso:O33,modificar')
        ->name('evaluaciones.notas');

    Route::get('/evaluaciones/promedios/{carga}', [EvaluacionController::class, 'promedios'])
        ->middleware('permiso:O33,modificar')
        ->name('evaluaciones.promedios');


    // O34 - BOLETA DE NOTAS
    Route::get('/reportes/boletas', [ReporteController::class, 'boletas'])
        ->middleware('permiso:O34,visualizar')
        ->name('reportes.boletas');

    Route::get('/reportes/boleta/{matricula}', [ReporteController::class, 'boleta'])
        ->middleware('permiso:O34,visualizar')
        ->name('reportes.boleta');


    // O35 - ACTA CONSOLIDADA
    Route::get('/evaluaciones/acta/{carga}', [ReporteController::class, 'acta'])
        ->middleware('permiso:O35,visualizar')
        ->name('reportes.acta');

});
