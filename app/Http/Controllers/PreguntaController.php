<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evaluacion;
use App\Models\Pregunta;

class PreguntaController extends Controller
{
    public function index($evaluacionId)
    {
        $evaluacion = Evaluacion::with(['grupo', 'preguntas'])->findOrFail($evaluacionId);
        $grupo = $evaluacion->grupo; // Obtenemos el grupo al que pertenece la evaluación
        $preguntas = $evaluacion->preguntas; // Obtenemos las preguntas relacionadas con la evaluación

        return view('VistasDocentes.VistaGrupo.evaluaciones', compact('evaluacion', 'grupo', 'preguntas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pregunta' => 'required|string',
            'evaluacion_id' => 'required|exists:evaluaciones,id',
            'max_escala' => 'required|integer', // Validación del máximo de la escala
        ]);

        Pregunta::create($request->all());

        return redirect()->back()->with('success', 'Pregunta creada con éxito.');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'pregunta' => 'required|string',
            'max_escala' => 'required|integer|min:5|max:10', // Validación de escala entre 1 y 10
        ]);

        $pregunta = Pregunta::findOrFail($id);
        $pregunta->update([
            'pregunta' => $request->input('pregunta'),
            'max_escala' => $request->input('max_escala'),
        ]);

        return redirect()->back()->with('success', 'Pregunta actualizada con éxito.');
    }

    public function destroy($id)
    {
        $pregunta = Pregunta::findOrFail($id);
        $pregunta->delete();

        return redirect()->back()->with('success', 'Pregunta eliminada con éxito.');
    }
}
