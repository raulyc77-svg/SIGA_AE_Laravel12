<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Matricula extends Model {
 protected $table='matriculas'; protected $fillable=["estudiante_id", "carga_lectiva_id", "fecha_matricula", "estado"];
 public function relacion() {return $this->belongsTo(Estudiante::class);}
}
