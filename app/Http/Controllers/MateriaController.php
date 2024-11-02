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

    // En MateriaController
public function materia($id)
{
    $grupo = Grupo::findOrFail($id); // Asegúrate de que el modelo `Grupo` esté relacionado con tus materias
    return view('VistasEstudiantes.materia', compact('grupo'));
}

    public function mostrar($id)
    {
        $usuario = Auth::user();
        $grupo = Grupo::with(['equipos.miembros'])->find($id);

        if (!$grupo) {
            return redirect()->back()->with('error', 'Grupo no encontrado.');
        }

        $usuarioTieneEquipo = $grupo->equipos()->where('creador_id', $usuario->id)->exists();
        $usuarioEsMiembro = $grupo->equipos()->whereHas('miembros', function ($query) use ($usuario) {
            $query->where('usuario_id', $usuario->id);
        })->exists();
        $usuarioTieneEquipo = $usuarioTieneEquipo || $usuarioEsMiembro;
        $usuariosEstudiantes = Usuario::where('role_id', 2)->get();
        $usuariosEnEquipo = $grupo->equipos()->with('miembros')->get()->flatMap(function ($equipo) {
            return $equipo->miembros; 
        });

        $usuariosEstudiantes = $usuariosEstudiantes->diff($usuariosEnEquipo);
        // $usuariosEstudiantes = $usuariosEstudiantes->reject(function ($user) use ($grupo) {
        //     return $grupo->equipos->contains('creador_id', $user->id);
        // });

        return view('VistasEstudiantes.vistaMateria', compact('grupo', 'usuario', 'usuarioTieneEquipo', 'usuariosEstudiantes'));
    }
}
