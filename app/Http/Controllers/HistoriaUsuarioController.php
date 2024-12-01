<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipo;
use App\Models\HistoriaUsuario;
use App\Models\Sprint;

class HistoriaUsuarioController extends Controller
{
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'prioridad' => 'required|in:Alta,Media,Baja',
            'estado' => 'required|in:Pendiente,En progreso,Completada',
            'criterios_aceptacion' => 'required|string',
            'sprint_id' => 'required|exists:sprints,id', // Verifica que el sprint exista
        ]);

        // Crear la historia de usuario
        HistoriaUsuario::create($validated);

        // Redirigir al sprint con mensaje de éxito
        return redirect()->route('sprints.show', $request->sprint_id)->with('success', 'Historia de usuario creada correctamente');
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'titulo' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'prioridad' => 'required|string',
        'estado' => 'required|string',
        'criterios_aceptacion' => 'required|string',
    ]);

    $historia = HistoriaUsuario::findOrFail($id);
    $historia->update([
        'titulo' => $request->titulo,
        'descripcion' => $request->descripcion,
        'prioridad' => $request->prioridad,
        'estado' => $request->estado,
        'criterios_aceptacion' => $request->criterios_aceptacion,
    ]);

    return redirect()->route('sprints.show', $historia->sprint_id)->with('success', 'Historia de usuario actualizada');
}

    public function destroy($id)
    {
        $historia = HistoriaUsuario::findOrFail($id);
        $historia->delete();
        return redirect()->route('sprints.show', $historia->sprint_id)->with('success', 'Historia de usuario eliminada');
    }
}
