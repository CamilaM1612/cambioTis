<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sprint;
use Illuminate\Support\Facades\Auth;

class SprintPlannerController extends Controller
{
    public function index()
    {
        // Obtener los equipos del usuario autenticado
        $equipos = Auth::user()->equipos()->with('proyectos')->get();
        return view('VistasEstudiantes.sprint-planner', compact('equipos'));
    }

    public function getSprints(Request $request, $proyectoId)
    {
        // Obtener los sprints del proyecto seleccionado
        $sprints = Sprint::where('proyecto_id', $proyectoId)->get();
        return response()->json($sprints);
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'proyecto_id' => 'required|exists:proyectos,id',
        'nombre' => 'required|string|max:255',
        'objetivo' => 'nullable|string',
        'fecha_inicio' => 'required|date',
        'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
    ]);

    Sprint::create($validated);

    return redirect()->route('sprint.planner')->with('success', 'Sprint creado exitosamente.');
}


public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'objetivo' => 'required|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
        ]);

        $sprint = Sprint::findOrFail($id);
        $sprint->update([
            'nombre' => $request->nombre,
            'objetivo' => $request->objetivo,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
        ]);

        return redirect()->back()->with('success', 'Sprint actualizado correctamente.');
    }


    public function destroy($id)
    {
        $sprint = Sprint::findOrFail($id);
        $sprint->delete();

        return redirect()->back()->with('success', 'Sprint eliminado con éxito.');
    }
    
}
