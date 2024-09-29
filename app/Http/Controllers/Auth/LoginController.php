<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login'); 
    }

    public function adminAcceso()
    {
        return view('admin.inicioAdmin');
    }

    public function studentAcceso()
    {
        return view('student.inicioStudent'); 
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
    
            if ($user->rol->name === 'Administrador') {
                return redirect()->route('ruta.admin');
            } elseif ($user->rol->name === 'Estudiante') {
                return redirect()->route('ruta.estudiante');
            }
        }
    }
    
    public function logout(Request $request)
    {
        Auth::logout(); 
       return view('login'); 
    }
}
