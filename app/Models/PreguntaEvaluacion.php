<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreguntaEvaluacion extends Model
{
    use HasFactory;

    protected $table = 'preguntas_evaluacion';
    
    protected $fillable = [
        'evaluacion_id',
        'pregunta',
        'tipo_respuesta'
    ];

    // Relación con Evaluación
    public function evaluacion()
    {
        return $this->belongsTo(Evaluacion::class);
    }

    // Relación con Respuestas de Evaluación
    public function respuestas()
    {
        return $this->hasMany(RespuestaEvaluacion::class);
    }
}
