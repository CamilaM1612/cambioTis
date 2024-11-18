<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\equipo;
use Illuminate\Support\Facades\Auth;
use App\Models\Grupo;

class EquipoController extends Controller
{

    public function crear($grupoId)
    {
        $grupo = Grupo::find($grupoId);
        $usuariosEstudiantes = $grupo->usuarios;
        $usuariosSinEquipo = $usuariosEstudiantes->filter(function ($usuario) {
            return !$usuario->equipos->count(); // Verifica que el usuario no tenga equipos
        });

        return view('VistasEstudiantes.crearEquipo', compact('grupo', 'usuariosSinEquipo'));
    }
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

        return redirect()->route('equipo.crear', $grupoId)->with('success', 'Equipo creado exitosamente.');
    }
    public function update(Request $request, $id)
{
    $request->validate([
        'nombre_empresa' => 'required|string|max:255',
        'correo_empresa' => 'required|email|max:255',
        'link_drive' => 'required|url',
    ]);

    $equipo = Equipo::findOrFail($id);
    $equipo->nombre_empresa = $request->nombre_empresa;
    $equipo->correo_empresa = $request->correo_empresa;
    $equipo->link_drive = $request->link_drive;
    $equipo->save();

    return redirect()->route('equipo.crear', $equipo->grupo_id)->with('success', 'Equipo actualizado exitosamente.');
}

    
    public function destroy($id)
    {
        $equipo = Equipo::findOrFail($id);
        $equipo->delete();
    
        return redirect()->route('equipo.crear', $equipo->grupo_id)->with('success', 'Equipo eliminado exitosamente.');
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
        $equipos = $usuario->equipos()->with('sprints', 'miembros', 'grupo')->get();

        return view('VistasEstudiantes.misEquipos', compact('equipos'));
    }
}
