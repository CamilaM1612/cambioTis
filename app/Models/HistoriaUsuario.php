<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoriaUsuario extends Model
{
    use HasFactory;
    protected $table = 'historias_de_usuario';

    protected $fillable = [
        'titulo',
        'descripcion',
        'sprint_id',
        'prioridad',
        'estado',
        'criterios_aceptacion'
    ];

    public function sprint()
    {
        return $this->belongsTo(Sprint::class, 'sprint_id'); // Relación con la tabla sprints
    }

    public function subtareas()
{
    return $this->hasMany(Subtarea::class);
}

}
