<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sprint;

class AutoEvaluacionController extends Controller
{
    public function index()
    {
        $usuario = auth()->user(); // Usuario autenticado
        $sprints = Sprint::whereHas('equipo.miembros', function ($query) use ($usuario) {
            $query->where('usuarios.id', $usuario->id); // Filtrar por usuario
        })->get();
    
        return view('VistasEstudiantes.autoevaluaciones', compact('sprints'));
    }
    

}
