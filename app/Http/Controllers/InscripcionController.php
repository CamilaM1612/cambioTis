<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupo;
use Illuminate\Support\Facades\Auth;

class InscripcionController extends Controller
{
    public function inscripcion()
    {
        $grupos = Grupo::all();
        $usuario = Auth::user();
        return view('VistasEstudiantes.inscripcion', compact('grupos', 'usuario'));
    }
    

    public function registrar(Request $request)
    {
        $request->validate([
            'codigo' => 'required|string',
        ]);

        $grupo = Grupo::where('codigo', $request->codigo)->first();

        if (!$grupo) {
            return redirect()->back()->with('error', 'Código de grupo inválido.');
        }
        if (Auth::user()->gruposAsignados()->where('grupo_id', $grupo->id)->exists()) {
            return redirect()->back()->with('error', 'Ya estás registrado en este grupo.');
        }
        Auth::user()->gruposAsignados()->attach($grupo->id);

        return redirect()->route('estudiante.dashboard')->with('success', 'Te has registrado exitosamente en el grupo.');
    }
}
