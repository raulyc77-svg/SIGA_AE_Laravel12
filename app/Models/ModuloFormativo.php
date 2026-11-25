<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModuloFormativo extends Model
{
    protected $table = 'modulos_formativos';

    protected $fillable = ['programa_estudio_id', 'nombre', 'descripcion', 'estado'];

    protected $casts = ['estado' => 'boolean'];

    public function programa()
    {
        return $this->belongsTo(ProgramaEstudio::class, 'programa_estudio_id');
    }

    public function unidadesDidacticas()
    {
        return $this->hasMany(UnidadDidactica::class, 'modulo_formativo_id');
    }
}
