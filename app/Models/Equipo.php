<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;
    protected $table = 'equipos';

    protected $fillable = [
        'nombre_empresa',
        'correo_empresa',
        'link_drive',
        'min_personas',
        'max_personas',
        'grupo_id',
        'creador_id'
    ];

    // Relación con el modelo Grupo
    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }
// En el modelo Equipo
public function creador()
{
    return $this->belongsTo(Usuario::class, 'creador_id');
}

    public function miembros()
    {
        return $this->belongsToMany(Usuario::class, 'equipo_user', 'equipo_id', 'user_id');
    }
}
