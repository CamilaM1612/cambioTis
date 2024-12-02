<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evaluacion;
use App\Models\PreguntaEvaluacion;
use App\Models\Grupo;

class EvaluacionController extends Controller
{
    public function index()
    {
        // Obtener el docente autenticado
        $docente_id = auth()->user()->id;
    
        // Obtener los grupos que están relacionados con el docente autenticado
        $grupos = Grupo::where('docente_id', $docente_id)->get();
    
        // Obtener las evaluaciones relacionadas con estos grupos
        $evaluaciones = Evaluacion::whereIn('grupo_id', $grupos->pluck('id'))->get();
    
        return view('VistasDocentes.evaluaciones', compact('evaluaciones', 'grupos'));
    }
    


    public function store(Request $request)
{
    // Validación de los datos recibidos
    $request->validate([
        'grupo_id' => 'required|exists:grupos,id',
        'tipo' => 'required|in:autoevaluacion,evaluacion_cruzada,evaluacion_pares',
        'fecha_limite' => 'nullable|date',
        'docente_id' => 'required|exists:usuarios,id',
    ]);

    // Crear nueva evaluación con los datos proporcionados
    $evaluacion = new Evaluacion();
    $evaluacion->grupo_id = $request->grupo_id;
    $evaluacion->tipo = $request->tipo;
    $evaluacion->fecha_limite = $request->fecha_limite;
    $evaluacion->docente_id = $request->docente_id;
    $evaluacion->save();  // Guardamos la evaluación en la base de datos

    // Redirigir a la lista de evaluaciones con un mensaje de éxito
    return redirect()->route('evaluacion.index')->with('success', 'Evaluación creada correctamente');
}

public function show($id)
{
    // Obtener la evaluación con el grupo y docente relacionados, y las preguntas asociadas
    $evaluacion = Evaluacion::with('grupo', 'docente', 'preguntas')->findOrFail($id);
    
    // Retornar la vista con los datos necesarios
    return view('VistasDocentes.preguntasEvaluaciones', compact('evaluacion'));
}
public function storeQ(Request $request, $evaluacion_id)
    {
        // Validar los datos
        $validatedData = $request->validate([
            'pregunta' => 'required|string|max:255',
            'tipo_respuesta' => 'required|in:escala_1_5,escala_1_10,verdadero_falso,respuesta_corta,categorias,seleccion_multiple',
        ]);

        // Crear la pregunta y asociarla con la evaluación
        $pregunta = PreguntaEvaluacion::create([
            'evaluacion_id' => $evaluacion_id,
            'pregunta' => $validatedData['pregunta'],
            'tipo_respuesta' => $validatedData['tipo_respuesta'],
        ]);

        // Redirigir con un mensaje de éxito
        return redirect()->back()->with('success', 'Pregunta creada con éxito.');
    }

}
