<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;
    
    protected $table = 'comentarios';

    protected $fillable = ['contenido', 'docente_id', 'sprint_id', 'tarea_id'];

    public function docente()
    {
        return $this->belongsTo(Usuario::class, 'docente_id');
    }

    public function sprint()
    {
        return $this->belongsTo(Sprint::class);
    }

    public function tarea()
    {
        return $this->belongsTo(Tarea::class);
    }


}
