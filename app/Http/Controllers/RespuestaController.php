<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pregunta;
use App\Models\Respuesta;
use App\Models\Sprint;

class RespuestaController extends Controller
{
    public function mostrarFormulario(Sprint $sprint)
    {
        // Verificar si el usuario ya respondió las preguntas de este sprint
        $respuestaExistente = Respuesta::where('sprint_id', $sprint->id)
                                      ->where('usuario_id', auth()->id())
                                      ->exists();
    
        // Si ya existe una respuesta, redirigir con un mensaje
        if ($respuestaExistente) {
            return redirect()->route('sprint-planner', $sprint->id)
                             ->with('error', 'Ya has respondido a la autoevaluación de este sprint.');
        }
    
        // Obtener las preguntas de tipo autoevaluación
        $preguntas = Pregunta::where('evaluacion', 'autoevaluacion')->get();
    
        return view('VistasEstudiantes.formulario', compact('sprint', 'preguntas'));
    }
    

public function guardarRespuestas(Request $request, Sprint $sprint)
{
    // Verificar si el usuario ya ha respondido para este sprint
    $existeRespuesta = Respuesta::where('sprint_id', $sprint->id)
                                ->where('usuario_id', auth()->id())
                                ->exists();

    if ($existeRespuesta) {
        // Si ya existe una respuesta para este sprint, redirigir con un mensaje de error
        return redirect()->route('sprint-planner', $sprint->id)
                         ->with('error', 'Ya has respondido a la autoevaluación de este sprint.');
    }

    // Validación de las respuestas
    $request->validate([
        'respuestas' => 'required|array',
        'respuestas.*' => 'required|string', // o 'required|integer' según el tipo de pregunta
    ]);

    // Guardar las respuestas
    foreach ($request->respuestas as $preguntaId => $respuesta) {
        Respuesta::create([
            'sprint_id' => $sprint->id,
            'usuario_id' => auth()->id(),
            'pregunta_id' => $preguntaId,
            'respuesta' => $respuesta,
        ]);
    }

    return redirect()->route('sprint-planner', $sprint->id)
                     ->with('success', 'Respuestas guardadas exitosamente.');
}

}
