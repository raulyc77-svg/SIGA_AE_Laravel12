<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnidadDidactica extends Model
{
    protected $table = 'unidades_didacticas';

    protected $fillable = [
        'modulo_formativo_id', 'nombre', 'horas_totales', 'creditos', 'estado',
    ];

    protected $casts = ['estado' => 'boolean'];

    public function modulo()
    {
        return $this->belongsTo(ModuloFormativo::class, 'modulo_formativo_id');
    }
}
