<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\GrupoUsuario;
use App\Models\User;
use App\Models\Usuario;

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
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para crear un grupo.');
        }

        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
        ]);

        // Crear el grupo y almacenar el ID del docente que crea el grupo
        Grupo::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'docente_id' => Auth::user()->id, // Obtener el ID del usuario autenticado
        ]);

        // Redirigir a la página de grupos o donde sea necesario
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
