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

    //relacion con equipos
    public function equipos()
    {
        return $this->hasMany(Equipo::class);
    }
    
    //relacion con avisos
    public function avisos()
    {
        return $this->hasMany(Aviso::class);
    }
    
}
