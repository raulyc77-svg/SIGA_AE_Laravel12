<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class CriterioEvaluacion extends Model {
 protected $table='criterios_evaluacion'; protected $fillable=["carga_lectiva_id", "tipo", "nombre", "indicador", "porcentaje", "orden", "es_calificable", "estado"];
 public function relacion() {return $this->belongsTo(CargaLectiva::class);}
}
