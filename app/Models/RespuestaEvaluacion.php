<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RespuestaEvaluacion extends Model
{
    use HasFactory;

    protected $table = 'respuestas_evaluacion';

    protected $fillable = [
        'preguntas_evaluacion_id',
        'usuario_id',
        'respuesta',
    ];

    // Relación con Pregunta de Evaluación
    public function pregunta()
    {
        return $this->belongsTo(PreguntaEvaluacion::class, 'preguntas_evaluacion_id');
    }

    // Relación con Usuario (quien responde)
    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
