<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Calificacion extends Model {
 protected $table='calificaciones'; protected $fillable=["matricula_id", "criterio_evaluacion_id", "nota", "docente_id", "estudiante_id", "fecha_registro"];
 public function relacion() {return $this->belongsTo(Matricula::class);}
}
