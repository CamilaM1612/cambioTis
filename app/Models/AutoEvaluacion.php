<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AutoEvaluacion extends Model
{
    use HasFactory;
    protected $fillable = ['usuario_id', 'sprint_id', 'estado'];

    // Relación con Sprint
    public function sprint()
    {
        return $this->belongsTo(Sprint::class);
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function respuestas()
    {
        return $this->hasMany(RespuestaAutoEvaluacion::class);
    }
}
