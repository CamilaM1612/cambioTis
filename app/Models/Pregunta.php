<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    use HasFactory;

    protected $fillable = [
        'evaluacion_id',
        'pregunta',
        'max_escala'
    ];

    // Relación con la tabla de evaluaciones
    public function evaluacion()
    {
        return $this->belongsTo(Evaluacion::class);
    }
}