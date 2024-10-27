<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Recurso;
class RecursoController extends Controller
{
    public function index()
    {
        return view('recursos.index'); // Asegúrate de que la vista existe
    }

    public function store(Request $request)
    {
        // Validar que se suba un archivo y que sea un PDF
        $request->validate([
            'recurso' => 'required|file|mimes:pdf', // Validación para archivos PDF
        ]);

        if ($request->hasFile('recurso')) {
            // Guardar el archivo en storage/app/public/recursos
            $rutaArchivo = $request->file('recurso')->store('recursos', 'public');

            // Crear un nuevo registro en la base de datos
            Recurso::create([
                'nombre' => $request->file('recurso')->getClientOriginalName(),
                'ruta' => $rutaArchivo,
                'usuario_id' => auth()->user()->id, // Asegúrate de que el usuario esté autenticado
            ]);

            // Redirigir con un mensaje de éxito
            return redirect()->back()->with('success', 'Recurso subido con éxito');
        }

        // Redirigir con un mensaje de error si no se pudo subir
        return redirect()->back()->with('error', 'No se pudo subir el recurso');
    }
}
