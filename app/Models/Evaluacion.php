<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    use HasFactory;
    protected $table = 'evaluaciones';

    protected $fillable = [
        'grupo_id',
        'tipo',
        'fecha_limite',
        'docente_id',
    ];

    // Relación con Grupo
    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }

    // Relación con Docente (Usuario)
    public function docente()
    {
        return $this->belongsTo(Usuario::class, 'docente_id');
    }

    // Relación con Preguntas de Evaluación
    public function preguntas()
    {
        return $this->hasMany(PreguntaEvaluacion::class);
    }
}