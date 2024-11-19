<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RespuestaAutoEvaluacion extends Model
{
    use HasFactory;

    protected $fillable = ['auto_evaluacion_id', 'pregunta_id', 'respuesta'];

    // Relación con AutoEvaluacion
    public function autoEvaluacion()
    {
        return $this->belongsTo(AutoEvaluacion::class);
    }

    // Relación con Pregunta
    public function pregunta()
    {
        return $this->belongsTo(Pregunta::class);
    }
}
