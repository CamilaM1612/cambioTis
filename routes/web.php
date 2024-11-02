<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\AdminController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ContenidoController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\AvisoController;
use App\Http\Controllers\InscripcionController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\RecursoController;
use App\Http\Controllers\SprintController;
use App\Http\Controllers\ContenidoGrupoController;

//-----------------------GENERAL---------------------------------------
// Login y logout
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->name('login')->middleware('guest');

Route::get('/', function () {
    return view('principal');
})->name('principal');

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');
    //VISTA DE PERFIL
    Route::get('/perfil', [UsuarioController::class, 'showProfile'])->name('perfil.show');
    Route::get('/perfil/editar', [UsuarioController::class, 'editProfile'])->name('perfil.edit');
    Route::put('/perfil', [UsuarioController::class, 'updateProfile'])->name('perfil.update');

    //-----------------------VISTAS ADMINITRADORES---------------------------------------
    //CRUD Usuario
    Route::post('/register', [UsuarioController::class, 'store'])->name('usuarios.store');
    Route::get('/listaRegistrados', [UsuarioController::class, 'lista'])->name('listaRegistrados');
    Route::put('/usuarios/{id}', [UsuarioController::class, 'update'])->name('usuarios.update');
    Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');

    //-----------------------VISTAS DOCENTES---------------------------------------

    //Vista principal de los docentes
    Route::get('/docente/dashboard', function () {
        return view('VistasDocentes.inicio');
    })->name('docente.dashboard');

    //CRUD avisos
    Route::get('/docente/avisos', [AvisoController::class, 'index'])->name('avisos.create');
    Route::post('/docente/avisos', [AvisoController::class, 'store'])->name('avisos.store');
    Route::put('/docente/avisos-edit/{id}', [AvisoController::class, 'update'])->name('avisos.update');
    Route::delete('/docente/avisos-delete/{id}', [AvisoController::class, 'destroy'])->name('avisos.destroy');

    //CRUD grupos
    Route::get('/grupos', [GrupoController::class, 'index'])->name('grupos.index');
    Route::post('/grupos', [GrupoController::class, 'store'])->name('grupos.store');
    Route::put('/grupos/{id}', [GrupoController::class, 'update'])->name('grupos.update');
    Route::delete('/grupos/{id}', [GrupoController::class, 'destroy'])->name('grupos.destroy');

    //Agregar y eliminar estudiantes de un grupo
    Route::post('/grupo/agregar-estudiante', [GrupoController::class, 'agregarEstudiante'])->name('grupo.agregarEstudiante');
    Route::delete('/grupo/{grupo}/eliminar-estudiante/{usuario}', [GrupoController::class, 'eliminarEstudiante'])
        ->name('grupo.eliminarEstudiante');

    //Vista por grupos (individual)
    Route::get('/grupos/{id}', [ContenidoGrupoController::class, 'show'])->name('grupos.show');
    Route::get('/grupo/{id}/avisos', [ContenidoGrupoController::class, 'avisos'])->name('grupo.avisos');
    Route::get('/grupo/{id}/material', [ContenidoGrupoController::class, 'material'])->name('grupo.material');
    Route::get('/grupo/{id}/tareas', [ContenidoGrupoController::class, 'tareas'])->name('grupo.tareas');
    Route::get('/grupo/{id}/equipos', [ContenidoGrupoController::class, 'equipos'])->name('grupo.equipos');
    
    //-----------------------VISTAS ESTUDIANTES---------------------------------------



});






// Rutas de dashboard por roles
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

// Rutas específicas para docentes
// Route::middleware(['auth', 'checkrole:docente'])->group(function () {
//     Route::get('/docente/grupos', [GrupoController::class, 'index'])->name('grupos.index');
//     Route::get('/docente/grupos/crear', [GrupoController::class, 'create'])->name('grupos.create');
//     Route::post('/docente/grupos', [GrupoController::class, 'store'])->name('grupos.store');
// });

// Rutas para el restablecimiento de contraseña
Route::middleware('guest')->group(function () {
    Route::get('password/reset', [PasswordResetController::class, 'showResetRequestForm'])->name('password.request');
    Route::post('password/email', [PasswordResetController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [PasswordResetController::class, 'reset'])->name('password.update');
});

// Rutas para el perfil de usuario


// Rutas para estudiantes
// Route::middleware(['auth', 'checkrole:estudiante'])->group(function () {
//     Route::get('/grupos/create', [GrupoController::class, 'create'])->name('grupos.create');
//     Route::post('/grupos', [GrupoController::class, 'store'])->name('grupos.store');
//     Route::get('/student/projects', [InscripcionController::class, 'projects'])->name('student.projects');
//     Route::get('/student/projects/{id}', [InscripcionController::class, 'showProject'])->name('student.showProject');
//     Route::post('/student/projects/{id}/submit', [InscripcionController::class, 'submitProject'])->name('student.submitProject');
// });


// Rutas para estudiantes
Route::middleware(['auth', 'checkrole:estudiante'])->group(function () {
    Route::get('/estudiantes', [InscripcionController::class, 'index'])->name('estudiante.index');
    Route::get('/estudiantes/{id}/edit', [InscripcionController::class, 'edit'])->name('estudiante.edit');
    Route::put('/estudiantes/{id}', [InscripcionController::class, 'update'])->name('estudiante.update');
    Route::delete('/estudiantes/{id}', [InscripcionController::class, 'destroy'])->name('estudiante.destroy');
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



// Route::post('/grupos/registrar', [InscripcionController::class, 'registrar'])->name('grupos.registrar');

Route::middleware(['auth'])->group(function () {
    Route::get('/estudiante/dashboard', [MateriaController::class, 'dashboard'])->name('estudiante.dashboard');
    Route::get('/estudiante/inscripcion', [InscripcionController::class, 'inscripcion'])->name('estudiante.inscripcion');
    Route::post('/estudiante/registrar', [InscripcionController::class, 'registrar'])->name('estudiante.registrar');
    Route::get('/grupo/{id}', [MateriaController::class, 'mostrar'])->name('grupo.mostrar');
    Route::get('/grupo/menu/{id}', [MateriaController::class, 'materia'])->name('grupo.menu');
    
    Route::post('/store/{grupo}', [EquipoController::class, 'store'])->name('equipos.store');
    Route::post('/equipos/{equipo}/agregar-miembro', [EquipoController::class, 'agregarMiembro'])->name('equipos.agregarMiembro');
    Route::get('/mis-equipos', [EquipoController::class, 'misEquipos'])->name('usuario.equipos');
    // para crear sprint
    Route::post('/sprints', [SprintController::class, 'store'])->name('sprints.store');
    Route::put('/sprints/{id}', [SprintController::class, 'update'])->name('sprints.update');
    Route::delete('/sprints/{id}', [SprintController::class, 'destroy'])->name('sprints.destroy');
    Route::get('/sprint/{id}', [SprintController::class, 'show'])->name('sprints.show');

    // para crear tarea
    Route::post('/tareas', [TareaController::class, 'store'])->name('tareas.store');
    Route::put('/tareas/{tarea}', [TareaController::class, 'update'])->name('tareas.update');
    Route::delete('/tareas/{tarea}', [TareaController::class, 'destroy'])->name('tareas.destroy');
    
    //lista para docentes


});
Route::get('/grupos/lista', [GrupoController::class, 'getGruposWithEquiposAndSprints'])->name('grupos.lista');
