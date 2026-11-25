<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Rol extends Model {
 protected $table='roles'; protected $fillable=['nombre','descripcion'];
 public function usuarios(){return $this->belongsToMany(Usuario::class,'usuario_rol');}
 public function permisos(){return $this->belongsToMany(Permiso::class,'permiso_rol');}
}
