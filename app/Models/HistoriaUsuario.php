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
        'equipo_id',
        'prioridad',
        'estado',
        'criterios_aceptacion'
    ];

    // Relación con el equipo
    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }
}
