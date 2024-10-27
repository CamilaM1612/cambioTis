<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;

class UsuarioController extends Controller
{
    // Método para mostrar el formulario de registro
    public function create()
    {
        $roles = Rol::all();
        return view('registro', compact('roles'));
    }

    // Este método ya no se usará directamente en las rutas, se usará desde UserController
    public function lista()
{
    $usuarios = Usuario::all();
    return view('usuarios.lista', compact('usuarios'));
}
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:usuarios',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id',
            'phone' => 'nullable|string|max:15',
            'birthdate' => 'nullable|date',
        ]);

        // Crear el usuario
        $usuario = Usuario::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id,
            'phone' => $request->phone,
            'birthdate' => $request->birthdate,
            'estado' => true,
        ]);

        // Intentar enviar el correo
        try {
            Mail::to($usuario->email)->send(new WelcomeEmail($usuario));
            \Log::info('Correo enviado a: ' . $usuario->email); // Log del envío
        } catch (\Exception $e) {
            \Log::error('Error al enviar correo: ' . $e->getMessage());
        }

        // Redirigir o devolver una respuesta
        return redirect()->route('usuarios.index')->with('success', 'Usuario registrado con éxito!');
    }

    // Métodos de perfil
    public function showProfile()
    {
        $usuario = auth()->user(); 
        return view('perfil', compact('usuario'));
    }

    public function editProfile()
    {
        $usuario = auth()->user(); 
        return view('editarPerfil', compact('usuario'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:usuarios,email,' . auth()->id(),
            'phone' => 'nullable|string|max:15',
            'birthdate' => 'nullable|date',
        ]);

        $usuario = auth()->user(); 
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->phone = $request->phone;
        $usuario->birthdate = $request->birthdate;
        $usuario->save(); 

        return redirect()->route('perfil.show')->with('success', 'Perfil actualizado con éxito!');
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

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado con éxito!');
    }
    
    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado con éxito!');
    }

    
}
