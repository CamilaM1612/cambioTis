<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/menu', function () {
    return view('componentes.menu');
});

// Mostrar el formulario de login
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rutas para administradores
Route::group(['middleware' => ['auth', 'role:Administrador']], function () {
    Route::get('/admin/acceso', [LoginController::class, 'adminAcceso'])->name('ruta.admin');
    Route::get('/listaRegistrados', [UsuarioController::class, 'lista'])->name('listaRegistrados');
    Route::get('/register', [UsuarioController::class, 'create'])->name('register');
    Route::post('/register', [UsuarioController::class, 'store']);
    //CRUD USUARIO
    Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');
    Route::put('/usuarios/{id}', [UsuarioController::class, 'update'])->name('usuarios.update');

});


// Rutas para estudiantes
Route::group(['middleware' => ['auth', 'role:Estudiante']], function () {
    Route::get('/student/acceso', [LoginController::class, 'studentAcceso'])->name('ruta.estudiante');
});