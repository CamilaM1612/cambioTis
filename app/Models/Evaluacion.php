<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    protected $table = 'evaluaciones';
    protected $fillable = [
        'grupo_id',
        'titulo',
        'descripcion',
    ];

    public function preguntas()
    {
        return $this->hasMany(Pregunta::class);
    }

    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }
}
