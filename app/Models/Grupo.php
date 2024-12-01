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

    public function equipos()
    {
        return $this->hasMany(Equipo::class, 'grupo_id'); // Indicar la clave foránea 'grupo_id'
    }
    
    //relacion con avisos
    public function avisos()
    {
        return $this->hasMany(Aviso::class);
    }

    public function evaluaciones()
    {
        return $this->hasMany(Evaluacion::class);
    }
    
}
