<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    use HasFactory;

    // Aquí puedes especificar la tabla si no sigue la convención
    // protected $table = 'nombre_de_tu_tabla';

    // Aquí puedes definir los atributos que son asignables en masa
    protected $fillable = ['name', 'email', 'phone'];
}
