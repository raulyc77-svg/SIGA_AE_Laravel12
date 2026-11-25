<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;

class Usuario extends Authenticatable
{
    protected $table = 'usuarios';

    protected $fillable = ['username', 'email', 'password', 'activo', 'primer_inicio', 'ultimo_acceso'];
    protected $hidden = ['password', 'remember_token'];
    protected $casts = [
        'activo' => 'boolean',
        'primer_inicio' => 'boolean',
        'ultimo_acceso' => 'datetime',
    ];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Rol::class, 'usuario_rol');
    }

    public function docente()
    {
        return $this->hasOne(Docente::class, 'usuario_id');
    }

    public function estudiante()
    {
        return $this->hasOne(Estudiante::class, 'usuario_id');
    }

    public function tieneRol(string $nombre): bool
    {
        return $this->roles()->where('nombre', $nombre)->exists();
    }

    public function tienePermiso(string $codigo, string $accion = 'visualizar'): bool
    {
        if (!in_array($accion, ['visualizar', 'modificar'], true)) {
            return false;
        }

        $columna = $accion === 'modificar' ? 'puede_modificar' : 'puede_visualizar';

        return DB::table('usuario_rol')
            ->join('roles', 'roles.id', '=', 'usuario_rol.rol_id')
            ->join('permiso_rol', 'permiso_rol.rol_id', '=', 'roles.id')
            ->join('permisos', 'permisos.id', '=', 'permiso_rol.permiso_id')
            ->where('usuario_rol.usuario_id', $this->getKey())
            ->where('permisos.codigo', $codigo)
            ->where("permiso_rol.{$columna}", true)
            ->exists();
    }
}
