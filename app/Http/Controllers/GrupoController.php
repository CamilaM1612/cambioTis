<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\GrupoUsuario;
use App\Models\User;
use App\Models\Usuario;
use Illuminate\Support\Str;
class GrupoController extends Controller
{

    public function index()
    {
        $grupos = Grupo::with('usuarios')->get();
        $usuarios = Usuario::whereHas('rol', function ($query) {
            $query->where('name', 'estudiante');
        })->get();

        return view('VistasDocentes.crearGrupo', compact('grupos', 'usuarios'));
    }


    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para crear un grupo.');
        }

        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
        ]);

        $codigo = Str::random(6); 

        Grupo::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'codigo' => $codigo,
            'docente_id' => Auth::user()->id, 
        ]);

        return redirect()->route('grupos.index')->with('success', 'Grupo creado exitosamente.');
    }


    public function agregarEstudiante(Request $request)
    {
        $request->validate([
            'grupo_id' => 'required|exists:grupos,id',
            'usuario_id' => 'required|exists:usuarios,id',
        ]);

        // Comprobar si el estudiante ya pertenece a algún grupo
        $existe = GrupoUsuario::where('usuario_id', $request->usuario_id)->exists();

        if ($existe) {
            return redirect()->back()->with('error', 'El estudiante ya está asignado a otro grupo.');
        }

        // Agregar el estudiante al grupo
        GrupoUsuario::create([
            'grupo_id' => $request->grupo_id,
            'usuario_id' => $request->usuario_id,
        ]);

        return redirect()->back()->with('success', 'Estudiante agregado exitosamente al grupo.');
    }
}
