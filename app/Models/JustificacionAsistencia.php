<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class JustificacionAsistencia extends Model {
 protected $table='justificaciones_asistencia'; protected $fillable=["asistencia_id", "motivo", "nro_documento", "ruta_adjunto", "fecha_registro", "usuario_registro_id"];
 public function relacion() {return $this->belongsTo(Asistencia::class);}
}
