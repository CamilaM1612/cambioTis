<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipo;
use App\Models\HistoriaUsuario;

class HistoriaUsuarioController extends Controller
{
    public function show($equipo_id)
    {
        $equipo = Equipo::find($equipo_id);  // Obtienes el equipo
        $historias = HistoriaUsuario::where('equipo_id', $equipo_id)->get();  // Obtienes las historias de usuario del equipo
        return view('VistasEstudiantes.HistoriaUsuario', compact('equipo', 'historias'));  // Pasas todo a la vista
    }


    public function store(Request $request, $equipo_id)
{
    $request->validate([
        'titulo' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'prioridad' => 'required|in:baja,media,alta',
        'estado' => 'required|in:pendiente,en progreso,completada',
        'criterios_aceptacion' => 'nullable|string', // Aseguramos que sea solo texto
    ]);

    // Guardamos la historia de usuario como texto simple en criterios_aceptacion
    HistoriaUsuario::create([
        'titulo' => $request->titulo,
        'descripcion' => $request->descripcion,
        'equipo_id' => $equipo_id,
        'prioridad' => $request->prioridad,
        'estado' => $request->estado,
        'criterios_aceptacion' => $request->criterios_aceptacion, // Guardamos texto
    ]);

    return redirect()->route('historias.show', $equipo_id)->with('success', 'Historia de usuario creada exitosamente.');
}
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'criterios_aceptacion' => 'required|string', // Aseguramos que sea solo texto
            'prioridad' => 'required|in:baja,media,alta',
            'estado' => 'required|in:pendiente,en progreso,completada',
        ]);
    
        $historia = HistoriaUsuario::find($id);
    
        if (!$historia) {
            return redirect()->route('historias.index')->with('error', 'Historia de usuario no encontrada.');
        }
    
        // Actualizamos los datos, asegurándonos de que criterios_aceptacion sea texto plano
        $historia->titulo = $validatedData['titulo'];
        $historia->descripcion = $validatedData['descripcion'];
        $historia->criterios_aceptacion = $validatedData['criterios_aceptacion']; // Guardamos texto
        $historia->prioridad = $validatedData['prioridad'];
        $historia->estado = $validatedData['estado'];
        $historia->save();
    
        return redirect()->route('historias.show', $historia->equipo_id)->with('success', 'Historia de usuario actualizada correctamente.');
    }

    public function destroy($id)
    {
        $historia = HistoriaUsuario::find($id);

        if ($historia) {
            $historia->delete();
            return redirect()->back()->with('success', 'Historia de usuario eliminada correctamente.');
        }

        return redirect()->back()->with('error', 'Historia de usuario no encontrada.');
    }
}
