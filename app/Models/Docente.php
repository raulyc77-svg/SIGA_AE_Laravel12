<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Docente extends Model {
 protected $table='docentes'; protected $fillable=["usuario_id", "codigo_docente", "apellidos", "nombres", "especialidad", "telefono", "estado"];
 public function relacion() {return $this->belongsTo(Usuario::class,'usuario_id');}
}
