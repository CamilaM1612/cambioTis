<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    // Método para mostrar el formulario de registro
    public function create()
    {
        $roles = Rol::all();
        return view('registro', compact('roles')); // Asegúrate de tener una vista llamada 'register.blade.php'
    }

   
    public function lista()
    {
        $usuarios = Usuario::with('rol')->get(); 
        $roles = Rol::all(); // Asegúrate de obtener todos los roles aquí
        return view('lista', compact('usuarios', 'roles')); // Pasa tanto usuarios como roles
    }
    
    // Método para manejar la lógica de registro
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:usuarios',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id', // Validar que el role_id exista en roles
            'phone' => 'nullable|string|max:15',
            'birthdate' => 'nullable|date',
        ]);

        Usuario::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id,
            'phone' => $request->phone,
            'birthdate' => $request->birthdate,
            'estado' => true,
        ]);
        // Redirigir o devolver una respuesta
        return redirect()->route('listaRegistrados')->with('success', 'Usuario registrado con éxito!');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:usuarios,email,'.$id,
            'role_id' => 'required|exists:roles,id',
            'estado' => 'required|boolean',
        ]);
    
        $usuario = Usuario::findOrFail($id);
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->role_id = $request->role_id;
        $usuario->estado = $request->estado;
        $usuario->save();
    
        return redirect()->route('listaRegistrados')->with('success', 'Usuario actualizado con éxito!');
    }
    
    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);

        $usuario->delete();

        return redirect()->route('listaRegistrados')->with('success', 'Usuario eliminado con éxito!');
    }
}
