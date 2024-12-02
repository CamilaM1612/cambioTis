<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subtarea extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo', 
        'descripcion', 
        'estado', 
        'historia_usuario_id', 
        'miembro_asignado'
    ];

    // Relación con HistoriaUsuario
    public function historiaUsuario()
    {
        return $this->belongsTo(HistoriaUsuario::class, 'historia_usuario_id');
    }
    public function miembroAsignado()
{
    return $this->belongsTo(Usuario::class, 'miembro_asignado');
}

    
}