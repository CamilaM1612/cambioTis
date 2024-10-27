<?php
// app/Http/Controllers/EstudianteController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estudiante; // Asegúrate de tener el modelo correcto

class EstudianteController extends Controller
{
    public function dashboard()
    {
        // Obtener todos los estudiantes
        $estudiantes = Estudiante::all();

        // Pasar los estudiantes a la vista
        return view('estudiante.dashboard', compact('estudiantes'));
    }
}
