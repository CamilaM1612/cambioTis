<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comentario;

class ComentarioController extends Controller
{
    public function storeSprintComentario(Request $request, $sprintId)
    {
        $request->validate(['contenido' => 'required|string']);

        Comentario::create([
            'contenido' => $request->contenido,
            'docente_id' => auth()->id(),
            'sprint_id' => $sprintId,
        ]);

        return redirect()->back()->with('success', 'Comentario agregado al sprint.');
    }

    public function storeTareaComentario(Request $request, $tareaId)
    {
        $request->validate(['contenido' => 'required|string']);

        Comentario::create([
            'contenido' => $request->contenido,
            'docente_id' => auth()->id(),
            'tarea_id' => $tareaId,
        ]);

        return redirect()->back()->with('success', 'Comentario agregado a la tarea.');
    }

    public function destroySprintComentario($comentarioId)
    {

        $comentario = Comentario::where('id', $comentarioId)->whereNotNull('sprint_id')->firstOrFail();

        // Elimina el comentario
        $comentario->delete();

        return redirect()->back()->with('success', 'Comentario del sprint eliminado correctamente.');
    }

    public function destroyTareaComentario($comentarioId)
    {
        $comentario = Comentario::where('id', $comentarioId)->whereNotNull('tarea_id')->firstOrFail();

        // Elimina el comentario
        $comentario->delete();

        return redirect()->back()->with('success', 'Comentario de la tarea eliminado correctamente.');
    }
}
