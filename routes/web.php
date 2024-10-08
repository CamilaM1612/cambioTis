<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\PasswordResetController;

// Ruta para mostrar el formulario de registro
Route::get('/register', [UsuarioController::class, 'create'])->name('register');
Route::post('/register', [UsuarioController::class, 'store'])->name('usuarios.store');
Route::get('/listaRegistrados', [UsuarioController::class, 'lista'])->name('listaRegistrados');

Route::put('/usuarios/{id}', [UsuarioController::class, 'update'])->name('usuarios.update');

// Ruta para manejar la eliminación
Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');

Route::get('/principal', function () {
    return view('principal');
})->name('principal');

Route::get('/', function () {
    return redirect()->route('principal');
});

// Mostrar el formulario de login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->name('login')->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Rutas de dashboard por roles
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('VistasAdmin.inicio'); 
    })->name('admin.dashboard');

    Route::get('/student/dashboard', function () {
        return view('VistasEstudiantes.inicio'); 
    })->name('student.dashboard');

    Route::get('/docente/dashboard', function () {
        return view('VistasDocentes.inicio');
    })->name('docente.dashboard');  
});

// Rutas específicas para docentes
Route::middleware(['auth', 'role:docente'])->group(function () {
    Route::get('/docente/grupos', [GrupoController::class, 'index'])->name('grupos.index');
    Route::get('/docente/grupos/crear', [GrupoController::class, 'create'])->name('grupos.create');
    Route::post('/docente/grupos', [GrupoController::class, 'store'])->name('grupos.store');
});

// Rutas para el restablecimiento de contraseña
Route::middleware('guest')->group(function () {
    Route::get('password/reset', [PasswordResetController::class, 'showResetRequestForm'])->name('password.request');
    Route::post('password/email', [PasswordResetController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [PasswordResetController::class, 'reset'])->name('password.update');
});

// Rutas para el perfil de usuario
Route::middleware(['auth'])->group(function () {
    Route::get('/perfil', [UsuarioController::class, 'showProfile'])->name('perfil.show');
    Route::get('/perfil/editar', [UsuarioController::class, 'editProfile'])->name('perfil.edit');
    Route::put('/perfil', [UsuarioController::class, 'updateProfile'])->name('perfil.update');
});

