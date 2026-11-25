<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Asistencia extends Model {
 protected $table='asistencias'; protected $fillable=["sesion_clase_id", "matricula_id", "estado", "observacion"];
 public function relacion() {return $this->belongsTo(SesionClase::class);}
}
