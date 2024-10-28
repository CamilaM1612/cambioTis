<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Notifications\CustomResetPasswordNotification; // Asegúrate de importar esta clase
use App\Models\Result; // Asegúrate de que el modelo Result exista
use App\Models\Rol; // Asegúrate de que el modelo Rol exista

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'usuarios'; // Asegúrate de que el nombre sea correcto

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id', // Asegúrate de que 'role_id' se corresponda con tu base de datos
    ];

    // Relación con Proyectos
    public function projects()
    {
        return $this->hasMany(Project::class); // Suponiendo que cada usuario puede tener múltiples proyectos
    }

    // Relación con Resultados
    public function results()
    {
        return $this->hasMany(Result::class); // Suponiendo que cada usuario puede tener múltiples resultados
    }

    // Relación con Rol
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'role_id'); // Asegúrate de que 'role_id' se corresponda con tu base de datos
    }
    public function hasRole($roleName)
    {
        return $this->role && $this->role->name === $roleName;
    }
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomResetPasswordNotification($token));
    }
    public function recursos()
    {
        return $this->hasMany(Recurso::class, 'usuario_id');
    }

    // Relación uno a muchos con grupos (si el usuario es docente)
    public function grupos()
    {
        return $this->hasMany(Grupo::class, 'docente_id');
    }

    // Relación muchos a muchos con grupos (si el usuario es estudiante)
    public function gruposAsignados()
    {
        return $this->belongsToMany(Grupo::class, 'grupo_usuario', 'usuario_id', 'grupo_id');
    }
}
