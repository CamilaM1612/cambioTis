<?php

// app/Http/Controllers/AdminController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario; // Asegúrate de usar el modelo correcto

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard'); // Vista del dashboard para administradores
    }

    public function index()
    {
        // Cambia el '1' por el ID real que corresponde al rol de administrador en tu base de datos
        $administradores = Usuario::where('role_id', 1)->get(); // Usa el modelo Usuario

        return view('admin.index', compact('administradores')); // Asegúrate de que sea 'admin.index'
    }

    public function edit($id)
    {
        $administrador = Usuario::findOrFail($id); // Asegúrate de usar el modelo correcto
        return view('admin.edit', compact('administrador')); // Asegúrate de que esta vista exista
    }

    public function update(Request $request, $id)
    {
        $administrador = Usuario::findOrFail($id);
        $administrador->update($request->all()); // Actualiza con los datos del formulario
        return redirect()->route('admin.index')->with('success', 'Administrador actualizado exitosamente');
    }

    public function destroy($id)
    {
        $administrador = Usuario::findOrFail($id);
        $administrador->delete(); // Elimina el administrador
        return redirect()->route('admin.index')->with('success', 'Administrador eliminado exitosamente');
    }
}

