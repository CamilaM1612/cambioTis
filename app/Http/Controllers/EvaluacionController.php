<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evaluacion;

class EvaluacionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'grupo_id' => 'required|exists:grupos,id', 
        ]);

        Evaluacion::create($request->all());

        return redirect()->back()->with('success', 'Evaluación creada con éxito.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'grupo_id' => 'required|exists:grupos,id',
        ]);

        $evaluacion = Evaluacion::findOrFail($id);
        $evaluacion->update($request->all());

        return redirect()->route('grupo.evaluaciones', $evaluacion->grupo_id)->with('success', 'Evaluación actualizada con éxito.');
        
    }
    public function destroy($id)
    {
        $evaluacion = Evaluacion::findOrFail($id);
        $grupoId = $evaluacion->grupo_id; 
        $evaluacion->delete();

        return redirect()->route('grupo.evaluaciones', $grupoId)->with('success', 'Evaluación eliminada con éxito.');
    }
}
