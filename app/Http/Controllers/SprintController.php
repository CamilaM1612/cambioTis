<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sprint;

class SprintController extends Controller
{
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([

            'nombre' => 'required|string|max:255',
            'objetivo' => 'nullable|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'equipo_id' => 'required|exists:equipos,id', // Asegúrate de que el equipo exista
        ]);

        // Crear un nuevo sprint
        Sprint::create([

            'nombre' => $request->nombre,
            'objetivo' => $request->objetivo,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'equipo_id' => $request->equipo_id,
        ]);

        // Redirigir o devolver una respuesta
        return redirect()->back()->with('success', 'Sprint creado con éxito.');
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




    public function show($id)
    {
        $sprint = Sprint::with(['equipo.miembros', 'tareas.usuario'])->findOrFail($id);

        $equipo = $sprint->equipo;
        $miembros = $equipo->miembros;
        $tareasSinAsignar = $sprint->tareas->whereNull('usuario_id')->sortBy('created_at');

        // Calcular si el sprint ya finalizó
        $sprintFinalizado = now()->greaterThan($sprint->fecha_fin);

        return view('VistasEstudiantes.sprint', compact('sprint', 'equipo', 'miembros', 'tareasSinAsignar', 'sprintFinalizado'));
    }

    public function updateNota(Request $request, $id)
{
    $request->validate([
        'nota' => 'required|numeric|min:0|max:100',
    ]);

    $sprint = Sprint::findOrFail($id);
    $sprint->nota = $request->input('nota');
    $sprint->save();

    return redirect()->back()->with('success', 'Nota actualizada correctamente.');
}

}
