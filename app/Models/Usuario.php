<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Importar Authenticatable
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable // Extiende de Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id', // Añadir el campo role_id
        'phone',
        'birthdate',
        'estado',
    ];

    protected $hidden = [
        'password', // Ocultar la contraseña
        'remember_token', // Ocultar el token de recordatorio
    ];

    // Relación con Rol
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'role_id'); // Relación inversa
    }
}
