<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class CargaLectiva extends Model {
 protected $table='cargas_lectivas'; protected $fillable=["unidad_didactica_id", "semestre_lectivo_id", "docente_id", "seccion_id", "turno_id", "cupo", "estado"];
 public function relacion() {return $this->belongsTo(UnidadDidactica::class);}
}
