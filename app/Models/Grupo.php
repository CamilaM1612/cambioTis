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
        'codigo',
        'docente_id',
    ];

    public function usuarios()
    {
        return $this->belongsToMany(Usuario::class, 'grupo_usuario');
    }

    // Relación muchos a muchos con usuarios (los estudiantes asignados al grupo)
    // public function estudiantes()
    // {
    //     return $this->belongsToMany(Usuario::class, 'grupo_usuario', 'grupo_id', 'usuario_id');
    // }
}
