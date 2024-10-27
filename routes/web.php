<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContenidoController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\AvisoController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\RecursoController;

// Ruta para mostrar el formulario de registro
Route::get('/register', [UsuarioController::class, 'create'])->name('register');
Route::post('/register', [UsuarioController::class, 'store'])->name('usuarios.store');

// Rutas protegidas por middleware de autenticación y rol
Route::middleware(['auth', 'checkrole:Administrador'])->group(function () {
    Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
    Route::get('/listaRegistrados', [UsuarioController::class, 'lista'])->name('listaRegistrados');
    Route::put('/usuarios/{id}', [UsuarioController::class, 'update'])->name('usuarios.update');
    Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');
});

// Ruta principal
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
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/estudiante/dashboard', [EstudianteController::class, 'dashboard'])->name('estudiante.dashboard');
    Route::get('/docente/dashboard', [DocenteController::class, 'dashboard'])->name('docente.dashboard');
});

// Rutas específicas para docentes
Route::middleware(['auth', 'checkrole:docente'])->group(function () {
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

// Rutas para estudiantes
Route::middleware(['auth', 'checkrole:estudiante'])->group(function () {
    Route::get('/grupos/create', [GrupoController::class, 'create'])->name('grupos.create');
    Route::post('/grupos', [GrupoController::class, 'store'])->name('grupos.store');
    Route::get('/student/projects', [EstudianteController::class, 'projects'])->name('student.projects');
    Route::get('/student/projects/{id}', [EstudianteController::class, 'showProject'])->name('student.showProject');
    Route::post('/student/projects/{id}/submit', [EstudianteController::class, 'submitProject'])->name('student.submitProject');
});

// Rutas para docentes
Route::middleware(['auth', 'checkrole:docente'])->group(function () {
    Route::get('/docentes', [DocenteController::class, 'index'])->name('docente.index');
    Route::get('/docentes/{id}/edit', [DocenteController::class, 'edit'])->name('docente.edit');
    Route::put('/docentes/{id}', [DocenteController::class, 'update'])->name('docente.update');
    Route::delete('/docentes/{id}', [DocenteController::class, 'destroy'])->name('docente.destroy');
});

// Rutas para estudiantes
Route::middleware(['auth', 'checkrole:estudiante'])->group(function () {
    Route::get('/estudiantes', [EstudianteController::class, 'index'])->name('estudiante.index');
    Route::get('/estudiantes/{id}/edit', [EstudianteController::class, 'edit'])->name('estudiante.edit');
    Route::put('/estudiantes/{id}', [EstudianteController::class, 'update'])->name('estudiante.update');
    Route::delete('/estudiantes/{id}', [EstudianteController::class, 'destroy'])->name('estudiante.destroy');
});

// Rutas para administradores
Route::middleware(['auth', 'checkrole:administrador'])->group(function () {
    Route::get('/administradores', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/administradores/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/administradores/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/administradores/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
});

// Rutas de contenido
Route::get('/contenido', [ContenidoController::class, 'index'])->name('contenido.index');

// Rutas para recursos
Route::middleware(['auth'])->group(function () {
    Route::get('/recursos', [RecursoController::class, 'index'])->name('recursos.index');
    Route::post('/recursos', [RecursoController::class, 'store'])->name('recursos.store');
});

// Rutas para tareas
Route::middleware(['auth'])->group(function () {
    Route::get('/tareas', [TareaController::class, 'index'])->name('tareas.index');
    Route::post('/tareas', [TareaController::class, 'store'])->name('tareas.store');
});

// Rutas para avisos
Route::middleware(['auth'])->group(function () {
    Route::get('/docente/avisos', [AvisoController::class, 'create'])->name('avisos.create');
    Route::post('/docente/avisos', [AvisoController::class, 'store'])->name('avisos.store');
});

Route::get('/grupos', [GrupoController::class, 'index'])->name('grupos.index');


Route::middleware('auth')->group(function () {
    Route::post('/grupos', [GrupoController::class, 'store'])->name('grupos.store');
    Route::post('/grupo/agregar-estudiante', [GrupoController::class, 'agregarEstudiante'])->name('grupo.agregarEstudiante');
});