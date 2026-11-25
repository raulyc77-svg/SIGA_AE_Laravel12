<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
 public function up(): void {
  Schema::create('roles', function(Blueprint $t) {
   $t->id();
   $t->string('nombre',60)->unique();
   $t->string('descripcion',200)->nullable();
   $t->timestamps();

  });
  Schema::create('permisos', function(Blueprint $t) {
   $t->id();
   $t->string('codigo',10)->unique();
   $t->string('nombre',100);
   $t->string('modulo',60);
   $t->text('descripcion')->nullable();
   $t->timestamps();

  });
  Schema::create('permiso_rol', function(Blueprint $t) {
   $t->foreignId('rol_id')->constrained('roles')->cascadeOnDelete();
   $t->foreignId('permiso_id')->constrained('permisos')->cascadeOnDelete();
   $t->primary(['rol_id','permiso_id']);

  });
  Schema::create('usuarios', function(Blueprint $t) {
   $t->id();
   $t->string('username',60)->unique();
   $t->string('email',120)->unique();
   $t->string('password');
   $t->boolean('activo')->default(true);
   $t->boolean('primer_inicio')->default(true);
   $t->timestamp('ultimo_acceso')->nullable();
   $t->rememberToken();
   $t->timestamps();

  });
  Schema::create('usuario_rol', function(Blueprint $t) {
   $t->foreignId('usuario_id')->constrained('usuarios')->cascadeOnDelete();
   $t->foreignId('rol_id')->constrained('roles')->cascadeOnDelete();
   $t->primary(['usuario_id','rol_id']);

  });
  Schema::create('docentes', function(Blueprint $t) {
   $t->id();
   $t->foreignId('usuario_id')->unique()->constrained('usuarios')->cascadeOnDelete();
   $t->string('codigo_docente',30)->unique();
   $t->string('apellidos',100);
   $t->string('nombres',100);
   $t->string('especialidad',120)->nullable();
   $t->string('telefono',25)->nullable();
   $t->boolean('estado')->default(true);
   $t->timestamps();

  });
  Schema::create('estudiantes', function(Blueprint $t) {
   $t->id();
   $t->foreignId('usuario_id')->unique()->constrained('usuarios')->cascadeOnDelete();
   $t->string('codigo_estudiante',30)->unique();
   $t->string('apellidos',100);
   $t->string('nombres',100);
   $t->string('documento',20)->unique();
   $t->string('telefono',25)->nullable();
   $t->boolean('estado')->default(true);
   $t->timestamps();

  });
  Schema::create('programas_estudio', function(Blueprint $t) {
   $t->id();
   $t->string('nombre',150)->unique();
   $t->text('descripcion')->nullable();
   $t->boolean('estado')->default(true);
   $t->timestamps();

  });
  Schema::create('modulos_formativos', function(Blueprint $t) {
   $t->id();
   $t->foreignId('programa_estudio_id')->constrained('programas_estudio');
   $t->string('nombre',150);
   $t->text('descripcion')->nullable();
   $t->boolean('estado')->default(true);
   $t->timestamps();
   $t->unique(['programa_estudio_id','nombre']);

  });
  Schema::create('unidades_didacticas', function(Blueprint $t) {
   $t->id();
   $t->foreignId('modulo_formativo_id')->constrained('modulos_formativos');
   $t->string('nombre',150);
   $t->unsignedSmallInteger('horas_totales')->default(0);
   $t->unsignedSmallInteger('creditos')->default(0);
   $t->boolean('estado')->default(true);
   $t->timestamps();

  });
  Schema::create('semestres_lectivos', function(Blueprint $t) {
   $t->id();
   $t->string('nombre',50);
   $t->date('fecha_inicio');
   $t->date('fecha_fin');
   $t->string('estado',20)->default('planificado');
   $t->timestamps();

  });
  Schema::create('secciones', function(Blueprint $t) {
   $t->id();
   $t->string('nombre',30)->unique();
   $t->string('descripcion',120)->nullable();
   $t->timestamps();

  });
  Schema::create('turnos', function(Blueprint $t) {
   $t->id();
   $t->string('nombre',40)->unique();
   $t->time('hora_inicio')->nullable();
   $t->time('hora_fin')->nullable();
   $t->timestamps();

  });
  Schema::create('cargas_lectivas', function(Blueprint $t) {
   $t->id();
   $t->foreignId('unidad_didactica_id')->constrained('unidades_didacticas');
   $t->foreignId('semestre_lectivo_id')->constrained('semestres_lectivos');
   $t->foreignId('docente_id')->constrained('docentes');
   $t->foreignId('seccion_id')->constrained('secciones');
   $t->foreignId('turno_id')->constrained('turnos');
   $t->string('cupo',20)->nullable();
   $t->string('estado',20)->default('activo');
   $t->timestamps();
   $t->unique(['unidad_didactica_id','semestre_lectivo_id','docente_id','seccion_id','turno_id'],'uq_carga_lectiva');

  });
  Schema::create('matriculas', function(Blueprint $t) {
   $t->id();
   $t->foreignId('estudiante_id')->constrained('estudiantes');
   $t->foreignId('carga_lectiva_id')->constrained('cargas_lectivas');
   $t->date('fecha_matricula');
   $t->string('estado',20)->default('activo');
   $t->timestamps();
   $t->unique(['estudiante_id','carga_lectiva_id']);

  });
  Schema::create('criterios_evaluacion', function(Blueprint $t) {
   $t->id();
   $t->foreignId('carga_lectiva_id')->constrained('cargas_lectivas')->cascadeOnDelete();
   $t->string('tipo',40);
   $t->string('nombre',120);
   $t->string('indicador',180)->nullable();
   $t->decimal('porcentaje',5,2)->default(0);
   $t->unsignedSmallInteger('orden')->default(1);
   $t->boolean('es_calificable')->default(true);
   $t->boolean('estado')->default(true);
   $t->timestamps();

  });
  Schema::create('calificaciones', function(Blueprint $t) {
   $t->id();
   $t->foreignId('matricula_id')->constrained('matriculas')->cascadeOnDelete();
   $t->foreignId('criterio_evaluacion_id')->constrained('criterios_evaluacion');
   $t->decimal('nota',5,2)->nullable();
   $t->foreignId('docente_id')->constrained('docentes');
   $t->foreignId('estudiante_id')->constrained('estudiantes');
   $t->timestamp('fecha_registro')->nullable();
   $t->timestamps();
   $t->unique(['matricula_id','criterio_evaluacion_id']);

  });
  Schema::create('sesiones_clase', function(Blueprint $t) {
   $t->id();
   $t->foreignId('carga_lectiva_id')->constrained('cargas_lectivas')->cascadeOnDelete();
   $t->date('fecha');
   $t->unsignedSmallInteger('nro_sesion');
   $t->string('tema_desarrollado',200)->nullable();
   $t->decimal('horas_dictadas',5,2)->default(0);
   $t->timestamps();
   $t->unique(['carga_lectiva_id','fecha','nro_sesion']);

  });
  Schema::create('asistencias', function(Blueprint $t) {
   $t->id();
   $t->foreignId('sesion_clase_id')->constrained('sesiones_clase')->cascadeOnDelete();
   $t->foreignId('matricula_id')->constrained('matriculas')->cascadeOnDelete();
   $t->string('estado',2);
   $t->string('observacion',200)->nullable();
   $t->timestamps();
   $t->unique(['sesion_clase_id','matricula_id']);

  });
  Schema::create('justificaciones_asistencia', function(Blueprint $t) {
   $t->id();
   $t->foreignId('asistencia_id')->unique()->constrained('asistencias')->cascadeOnDelete();
   $t->string('motivo',250);
   $t->string('nro_documento',80)->nullable();
   $t->string('ruta_adjunto',255)->nullable();
   $t->date('fecha_registro');
   $t->foreignId('usuario_registro_id')->constrained('usuarios');
   $t->timestamps();

  });
 }
 public function down(): void {
  Schema::disableForeignKeyConstraints();
  foreach (['justificaciones_asistencia','asistencias','sesiones_clase','calificaciones','criterios_evaluacion','matriculas','cargas_lectivas','turnos','secciones','semestres_lectivos','unidades_didacticas','modulos_formativos','programas_estudio','estudiantes','docentes','usuario_rol','usuarios','permiso_rol','permisos','roles'] as $t) Schema::dropIfExists($t);
  Schema::enableForeignKeyConstraints();
 }
};
