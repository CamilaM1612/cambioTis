<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Usuario;

class LoginController extends Controller
{
    // Muestra el formulario de inicio de sesión
    public function showLoginForm()
    {
        return view('login'); // Asegúrate de tener una vista llamada 'login.blade.php'
    }

    // Maneja la lógica de inicio de sesión
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Intentar autenticar el usuario
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Obtener el usuario autenticado
            $user = Auth::user();

            // Verificar el rol usando la relación rol y el campo name
            if ($user->rol && $user->rol->name === 'Administrador') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->rol && $user->rol->name === 'Estudiante') {
                return redirect()->route('estudiante.dashboard');
            } elseif ($user->rol && $user->rol->name === 'Docente') {
                return redirect()->route('docente.dashboard');
            }

            // Redirigir a la página principal si no coincide el rol
            return redirect('/')->with('error', 'Rol no permitido.');
        }

        // Si falla la autenticación
        return back()->withErrors(['email' => 'Credenciales incorrectas.']);
    }

    // Maneja el cierre de sesión
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/'); // Redirige a la página principal después de cerrar sesión
    }
}
