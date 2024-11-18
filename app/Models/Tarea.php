<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;

    protected $table = 'tareas';

    protected $fillable = [
        'sprint_id',
        'usuario_id',
        'titulo',
        'descripcion',
        'estado',
        'prioridad',
        'fecha_inicio',
        'fecha_entrega',
    ];

    // Relacion con el modelo Sprint
    public function sprint()
    {
        return $this->belongsTo(Sprint::class);
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }
}

