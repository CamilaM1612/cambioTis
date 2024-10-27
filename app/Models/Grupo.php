<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    protected $table = 'grupos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'docente_id',
    ];

    // Relación con el usuario que creó el grupo (docente)
    // public function docente()
    // {
    //     return $this->belongsTo(Usuario::class, 'docente_id');
    // }
// En el modelo Grupo
public function usuarios()
{
    return $this->belongsToMany(Usuario::class, 'grupo_usuario');
}

    // Relación muchos a muchos con usuarios (los estudiantes asignados al grupo)
    public function estudiantes()
    {
        return $this->belongsToMany(Usuario::class, 'grupo_usuario', 'grupo_id', 'usuario_id');
    }
}

