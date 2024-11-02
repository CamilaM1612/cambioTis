<?php

// app/Http/Controllers/AdminController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Grupo;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function index()
    {
        $grupos = Grupo::where('usuario_id', auth()->id())->get();

        return view('layouts.menu', compact('grupos'));
    }
}
