<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recurso; // Asegúrate de importar el modelo Recurso

class ContenidoController extends Controller
{
    public function index()
{
    // Obtener todos los recursos desde la base de datos
    $recursos = Recurso::all();

    // Depurar los recursos para asegurarse de que existen
    // dd($recursos); // Descomenta esta línea para ver si los recursos están siendo obtenidos correctamente

    // Pasar los recursos a la vista
    return view('contenido.index', compact('recursos'));
}
}
