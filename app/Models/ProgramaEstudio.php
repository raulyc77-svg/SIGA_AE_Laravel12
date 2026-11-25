<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramaEstudio extends Model
{
    protected $table = 'programas_estudio';

    protected $fillable = ['nombre', 'descripcion', 'estado'];

    protected $casts = ['estado' => 'boolean'];

    public function modulosFormativos()
    {
        return $this->hasMany(ModuloFormativo::class, 'programa_estudio_id');
    }
}
