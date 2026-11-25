<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permiso;
use App\Models\Rol;
use App\Models\Usuario;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            'Administrador' => 'Administración general del sistema SIGA-AE.',
            'Coordinador Programa Estudios' => 'Gestión académica del programa de estudios.',
            'Docente' => 'Registro de indicadores, evaluaciones y asistencia.',
            'Estudiante' => 'Consulta de información académica propia.',
        ];

        foreach ($roles as $nombre => $descripcion) {
            Rol::firstOrCreate(['nombre' => $nombre], ['descripcion' => $descripcion]);
        }

        $items = [
            ['O11', 'Estudiantes', 'Archivos'],
            ['O12', 'Docentes', 'Archivos'],
            ['O13', 'Programas Estudio', 'Archivos'],
            ['O14', 'Módulos', 'Archivos'],
            ['O15', 'Itinerarios', 'Archivos'],
            ['O16', 'Periodos', 'Archivos'],
            ['O21', 'Importar Datos Matrícula', 'Procesos'],
            ['O22', 'Registrar / Asignar carga horaria', 'Procesos'],
            ['O23', 'Registrar Indicadores y Logro Aprendizaje', 'Procesos'],
            ['O24', 'Evaluaciones', 'Procesos'],
            ['O25', 'Asistencia Estudiantes', 'Procesos'],
            ['O31', 'Asignaciones Carga Docente', 'Consultas'],
            ['O32', 'Asistencia Estudiantes', 'Consultas'],
            ['O33', 'Registro de Evaluación', 'Consultas'],
            ['O34', 'Boleta de Notas', 'Consultas'],
            ['O35', 'Acta Consolidada', 'Consultas'],
            ['O41', 'Modificar Perfil', 'Herramientas'],
            ['O42', 'Cerrar Periodo', 'Herramientas'],
        ];

        foreach ($items as [$codigo, $nombre, $modulo]) {
            Permiso::firstOrCreate(
                ['codigo' => $codigo],
                ['nombre' => $nombre, 'modulo' => $modulo]
            );
        }

        // Matriz transcrita de la hoja oficial compartida por el usuario.
        // La modificación también concede visualización para que el usuario pueda abrir el formulario.
        $matriz = [
            'Administrador' => [
                'visualizar' => array_column($items, 0),
                'modificar' => ['O11', 'O12', 'O13', 'O16', 'O31', 'O32', 'O33', 'O34', 'O35', 'O41', 'O42'],
            ],
            'Coordinador Programa Estudios' => [
                'visualizar' => ['O11', 'O12', 'O13', 'O16'],
                'modificar' => ['O14', 'O15', 'O22', 'O31', 'O32', 'O33', 'O34', 'O35', 'O41'],
            ],
            'Docente' => [
                'visualizar' => ['O11', 'O15'],
                'modificar' => ['O23', 'O24', 'O25', 'O32', 'O33', 'O41'],
            ],
            'Estudiante' => [
                'visualizar' => ['O14', 'O15', 'O32', 'O34', 'O41'],
                'modificar' => [],
            ],
        ];

        foreach ($matriz as $nombreRol => $reglas) {
            $rol = Rol::where('nombre', $nombreRol)->firstOrFail();
            $asignaciones = [];

            $codigos = array_unique(array_merge($reglas['visualizar'], $reglas['modificar']));
            foreach ($codigos as $codigo) {
                $permiso = Permiso::where('codigo', $codigo)->firstOrFail();
                $asignaciones[$permiso->id] = [
                    'puede_visualizar' => in_array($codigo, $reglas['visualizar'], true)
                        || in_array($codigo, $reglas['modificar'], true),
                    'puede_modificar' => in_array($codigo, $reglas['modificar'], true),
                ];
            }

            $rol->permisos()->sync($asignaciones);
        }

        $administrador = Rol::where('nombre', 'Administrador')->firstOrFail();
        $usuario = Usuario::firstOrCreate(
            ['username' => 'admin'],
            [
                'email' => 'admin@siga-ae.local',
                'password' => bcrypt(env('SIGA_ADMIN_PASSWORD', 'Cambiar123!')),
                'activo' => true,
                'primer_inicio' => true,
            ]
        );
        $usuario->roles()->syncWithoutDetaching([$administrador->id]);
    }
}
