<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estudiante;
use App\Models\Grupo;
use Illuminate\Support\Facades\Auth;

class InscripcionController extends Controller
{
    public function dashboard()
    {
        $grupos = Grupo::all();
        $usuario = Auth::user();
        return view('VistasEstudiantes.dashboard', compact('grupos', 'usuario'));
    }


    public function registrar(Request $request)
    {
        $request->validate([
            'codigo' => 'required|string',
        ]);

        // Busca el grupo por código
        $grupo = Grupo::where('codigo', $request->codigo)->first();

        if (!$grupo) {
            return redirect()->back()->with('error', 'Código de grupo inválido.');
        }

        // Verifica si el estudiante ya está registrado en el grupo
        if (Auth::user()->gruposAsignados()->where('grupo_id', $grupo->id)->exists()) {
            return redirect()->back()->with('error', 'Ya estás registrado en este grupo.');
        }

        // Asocia al estudiante con el grupo
        Auth::user()->gruposAsignados()->attach($grupo->id);

        return redirect()->route('estudiante.dashboard')->with('success', 'Te has registrado exitosamente en el grupo.');
    }
}
