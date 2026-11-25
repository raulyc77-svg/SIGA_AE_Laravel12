<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class SemestreLectivo extends Model {
 protected $table='semestres_lectivos'; protected $fillable=["nombre", "fecha_inicio", "fecha_fin", "estado"];
 public function relacion() {return $this->hasMany(CargaLectiva::class);}
}
