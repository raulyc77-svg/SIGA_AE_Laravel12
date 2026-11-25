<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Seccion extends Model {
 protected $table='secciones'; protected $fillable=["nombre", "descripcion"];
 public function relacion() {return $this->hasMany(CargaLectiva::class);}
}
