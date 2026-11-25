<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Turno extends Model {
 protected $table='turnos'; protected $fillable=["nombre", "hora_inicio", "hora_fin"];
 public function relacion() {return $this->hasMany(CargaLectiva::class);}
}
