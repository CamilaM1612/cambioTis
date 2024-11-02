<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\equipo;
use Illuminate\Support\Facades\Auth;

class EquipoController extends Controller
{

    public function store(Request $request, $grupoId)
    {
        $request->validate([
            'nombre_empresa' => 'required|string|max:255',
            'correo_empresa' => 'required|email|max:255',
            'link_drive' => 'required|url',
        ]);

        $equipo = Equipo::create([
            'grupo_id' => $grupoId,
            'creador_id' => Auth::id(),
            'nombre_empresa' => $request->nombre_empresa,
            'correo_empresa' => $request->correo_empresa,
            'link_drive' => $request->link_drive,
            // 'min_personas' => 3,
            // 'max_personas' => 5,
        ]);

        return redirect()->route('grupo.mostrar', $grupoId)->with('success', 'Equipo creado exitosamente.');
    }

    public function agregarMiembro(Request $request, $equipoId)
    {
        $equipo = Equipo::findOrFail($equipoId);
        $usuarioId = $request->input('usuario_id');
        $equipo->miembros()->attach($usuarioId);
        return redirect()->back()->with('success', 'Miembro añadido exitosamente.');
    }


    public function misEquipos()
    {
        $usuario = Auth::user();
        // Carga los equipos con sus sprints
        $equipos = $usuario->equipos()->with('sprints', 'miembros', 'grupo')->get();

        return view('VistasEstudiantes.misEquipos', compact('equipos'));
    }
}
