<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupo;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;

class MateriaController extends Controller
{
    public function dashboard()
    {
        $grupos = Grupo::all();
        $usuario = Auth::user();
        return view('VistasEstudiantes.dashboard', compact('grupos', 'usuario'));
    }

    public function mostrar($id)
    {
        $usuario = Auth::user();
        $grupo = Grupo::with('equipos')->find($id);

        if (!$grupo) {
            return redirect()->back()->with('error', 'Grupo no encontrado.');
        }

        $usuarioTieneEquipo = $grupo->equipos()->where('creador_id', $usuario->id)->exists();
        // Suponiendo que el rol de "estudiante" tiene un ID específico, por ejemplo, 2.
        $usuariosEstudiantes = Usuario::where('role_id', 2)->get();
        return view('VistasEstudiantes.vistaMateria', compact('grupo', 'usuario', 'usuarioTieneEquipo', 'usuariosEstudiantes'));
    }
}
