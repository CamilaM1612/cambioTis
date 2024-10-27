<?php

namespace App\Http\Controllers;

use App\Models\Usuario; // Asegúrate de incluir el modelo Usuario
use App\Models\Rol; // Asegúrate de incluir el modelo Rol
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Obtener todos los usuarios y roles
        $usuarios = Usuario::all(); // Obtiene todos los usuarios
        $roles = Rol::all(); // Obtiene todos los roles

        // Retornar la vista y pasar los usuarios y roles
        return view('lista', compact('usuarios', 'roles'));
    }
}
