<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\Auth\LoginController;

// Ruta para mostrar el formulario de registro
Route::get('/register', [UsuarioController::class, 'create'])->name('register');
Route::post('/register', [UsuarioController::class, 'store'])->name('usuarios.store');
Route::get('/listaRegistrados', [UsuarioController::class, 'lista'])->name('listaRegistrados');

Route::put('/usuarios/{id}', [UsuarioController::class, 'update'])->name('usuarios.update');

// Ruta para manejar la eliminación
Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');

// Mostrar el formulario de login en la raíz
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('VistasAdmin.inicio'); 
    })->name('admin.dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/student/dashboard', function () {
        return view('VistasEstudiantes.inicio'); 
    })->name('student.dashboard');
});