<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sprint;

class SprintController extends Controller
{
    public function store(Request $request)
    {
        // Validar los datos recibidos
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'objetivo' => 'nullable|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'proyecto_id' => 'required|exists:proyectos,id', 
        ]);

        $sprint = Sprint::create([
            'nombre' => $validated['nombre'],
            'objetivo' => $validated['objetivo'],
            'fecha_inicio' => $validated['fecha_inicio'],
            'fecha_fin' => $validated['fecha_fin'],
            'proyecto_id' => $validated['proyecto_id'],
        ]);

        // Redirigir a la vista de planificación del proyecto con el nuevo sprint
        return redirect()->route('proyectos.planificacion', ['proyecto' => $validated['proyecto_id']])->with('success', 'Sprint creado exitosamente.');
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
        $sprint = Sprint::findOrFail($id);
        $historias = $sprint->historias;
        return view('VistasEstudiantes.backlog', compact('sprint', 'historias'));
    }
    
    

}
