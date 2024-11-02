<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Request;
use App\Models\Sprint;
use App\Models\Usuario;

class TareaController extends Controller
{

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'sprint_id' => 'required|exists:sprints,id',
            'usuario_id' => 'nullable|exists:usuarios,id',
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'estado' => 'required|in:Pendiente,En Proceso,Completado,Bloqueado,Revisar',
            'prioridad' => 'required|in:Alta,Media,Baja',
            'fecha_inicio' => 'nullable|date',
            'fecha_entrega' => 'nullable|date',
        ]);

        Tarea::create($validatedData);
        return redirect()->back()->with('success', 'Tarea creada exitosamente.');
    }

    public function update(Request $request, $id)
{
    // Validar los datos del formulario
    $validatedData = $request->validate([
        'titulo' => 'required|string|max:255',
        'descripcion' => 'nullable|string',
        'usuario_id' => 'nullable|exists:usuarios,id',
        'estado' => 'required|in:Pendiente,En Proceso,Completado,Bloqueado,Revisar',
        'prioridad' => 'required|in:Alta,Media,Baja',
        'fecha_inicio' => 'nullable|date',
        'fecha_entrega' => 'nullable|date',
        'sprint_id' => 'required|exists:sprints,id', // Asegúrate de que se pase el ID del sprint
    ]);

    // Buscar la tarea y actualizarla
    $tarea = Tarea::findOrFail($id);
    $tarea->update($validatedData);

    $usuario = Usuario::find($tarea->usuario_id);
    $progreso = $usuario->calcularProgresoPorSprint($tarea->sprint_id);

    return redirect()->back()->with('success', 'Tarea actualizada exitosamente. Progreso: ' . round($progreso) . '%');
}

    public function destroy($id)
    {
        $tarea = Tarea::findOrFail($id);
        $tarea->delete();
        return redirect()->back()->with('success', 'Tarea eliminada exitosamente.');
    }
}
