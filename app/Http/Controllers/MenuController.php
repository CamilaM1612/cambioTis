<?php

// app/Http/Controllers/AdminController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Grupo;
use App\Models\Equipo;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function index()
    {
        // Obtener los grupos en los que el usuario autenticado está inscrito
        $gruposInscritos = Auth::user()->gruposAsignados()->get();
        return view('layouts.menu', compact('gruposInscritos'));
    }
}
