<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupo;

class ContenidoGrupoController extends Controller
{
    public function show($id)
    {
        $grupo = Grupo::with('usuarios')->findOrFail($id);
        return view('VistasDocentes.VistaGrupo.material', compact('grupo'));
    }

    public function avisos($id)
    {
        $grupo = Grupo::with('avisos')->findOrFail($id);
        return view('VistasDocentes.VistaGrupo.avisos', compact('grupo'));
    }
    public function actividades($id)
    {
        $grupo = Grupo::with('equipos')->findOrFail($id);
        return view('VistasDocentes.VistaGrupo.actividades', compact('grupo'));
    } 
    public function equipos($id)
    {
        $grupo = Grupo::with('equipos')->findOrFail($id);
        $grupo = Grupo::with(['equipos.miembros', 'equipos.sprints'])->findOrFail($id);
        return view('VistasDocentes.VistaGrupo.equipos', compact('grupo'));
    
    }
}
