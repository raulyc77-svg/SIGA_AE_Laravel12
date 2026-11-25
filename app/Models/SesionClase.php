<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class SesionClase extends Model {
 protected $table='sesiones_clase'; protected $fillable=['carga_lectiva_id','fecha','nro_sesion','tema_desarrollado','horas_dictadas'];
 public function asistencias(){return $this->hasMany(Asistencia::class,'sesion_clase_id');}
}
