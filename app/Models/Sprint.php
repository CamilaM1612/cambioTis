<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sprint extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'objetivo',
        'fecha_inicio',
        'fecha_fin',
        'equipo_id',
        'nota'
    ];

    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }


    public function tareas()
    {
        return $this->hasMany(Tarea::class);
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }
}
