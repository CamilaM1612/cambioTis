<?php

// app/Http/Controllers/DocenteController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario; // Cambia User por Usuario

class DocenteController extends Controller
{
    public function dashboard()
    {
        return view('docente.dashboard');
    }

    public function index()
    {
        // Cambia el '2' por el ID real que corresponde al rol de docente en tu base de datos
        $docentes = Usuario::where('role_id', 2)->get(); // Usa el modelo Usuario

        return view('docente.index', compact('docentes')); // Asegúrate de que sea 'docente.index'
    }
    public function edit($id)
    {
    $docente = Usuario::findOrFail($id); // Asegúrate de usar el modelo correcto
    return view('docente.edit', compact('docente')); // Asegúrate de que esta vista exista
    }

}
