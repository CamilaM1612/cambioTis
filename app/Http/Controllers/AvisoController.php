<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AvisoController extends Controller
{
    public function create()
{
    // Muestra la vista del formulario para crear avisos
    return view('docente.avisos.create');
}

public function store(Request $request)
{
    // Valida los datos del aviso
    $request->validate([
        'titulo' => 'required|string|max:255',
        'contenido' => 'required|string',
    ]);

    // Crea y guarda el aviso en la base de datos
    Aviso::create([
        'titulo' => $request->titulo,
        'contenido' => $request->contenido,
        'user_id' => auth()->user()->id,  // Relacionar el aviso con el usuario autenticado
    ]);

    // Redirige con un mensaje de éxito
    return redirect()->route('avisos.create')->with('success', 'Aviso publicado con éxito');
}

}
