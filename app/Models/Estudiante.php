<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Estudiante extends Model {
 protected $table='estudiantes'; protected $fillable=["usuario_id", "codigo_estudiante", "apellidos", "nombres", "documento", "telefono", "estado"];
 public function relacion() {return $this->belongsTo(Usuario::class,'usuario_id');}
}
