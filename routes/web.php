<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\PreguntaController;
use App\Http\Controllers\AvisoController;
use App\Http\Controllers\InscripcionController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\ContenidoGrupoController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\misTareasController;
use App\Http\Controllers\HistoriaUsuarioController;
use App\Http\Controllers\ProyectosController;
use App\Http\Controllers\SubtareaController;
use App\Http\Controllers\SprintPlannerController;

use App\Http\Controllers\RespuestaController;

//-----------------------GENERAL---------------------------------------
// Login y logout
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->name('login')->middleware('guest');

Route::get('/', function () {
    return view('principal');
})->name('principal');

// Rutas para el restablecimiento de contraseña
Route::middleware('guest')->group(function () {
    Route::get('password/reset', [PasswordResetController::class, 'showResetRequestForm'])->name('password.request');
    Route::post('password/email', [PasswordResetController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [PasswordResetController::class, 'reset'])->name('password.update');
});

Route::middleware(['auth'])->group(function () {

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

    //VISTA DE PERFIL
    Route::get('/perfil', [UsuarioController::class, 'showProfile'])->name('perfil.show');
    Route::get('/perfil/editar', [UsuarioController::class, 'editProfile'])->name('perfil.edit');
    Route::put('/perfil', [UsuarioController::class, 'updateProfile'])->name('perfil.update');

    //-----------------------VISTAS ADMINITRADORES---------------------------------------
    Route::get('/administrador/inicio', function () {
        return view('VistasAdmin.inicio');
    })->name('admin.dashboard');
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
    Route::get('/grupo/{id}/evaluaciones', [ContenidoGrupoController::class, 'evaluaciones'])->name('grupo.evaluaciones');
    Route::get('/grupo/{id}/tareas', [ContenidoGrupoController::class, 'tareas'])->name('grupo.tareas');
    Route::get('/grupo/{id}/equipos', [ContenidoGrupoController::class, 'equipos'])->name('grupo.equipos');
    Route::get('/grupo/{id}/equipo/informacion', [ContenidoGrupoController::class, 'equipoDetalle'])->name('grupo.equipo.informacion');

    //CRUD de comentarios
    Route::post('/sprint/{sprintId}/comentarios', [ComentarioController::class, 'storeSprintComentario'])->name('comentarios.storeSprint');
    Route::delete('/sprint/comentario/{comentarioId}', [ComentarioController::class, 'destroySprintComentario'])->name('comentario.sprint.destroy');
    Route::post('/tarea/{tareaId}/comentarios', [ComentarioController::class, 'storeTareaComentario'])->name('comentarios.storeTarea');
    Route::delete('/tarea/comentario/{comentarioId}', [ComentarioController::class, 'destroyTareaComentario'])->name('comentario.tarea.destroy');

    Route::get('/preguntas', [PreguntaController::class, 'index'])->name('preguntas.index');
    Route::post('/preguntas', [PreguntaController::class, 'store'])->name('preguntas.store');
    Route::put('/pregunta/{id}', [PreguntaController::class, 'update'])->name('preguntas.update');
    Route::delete('/pregunta/{id}', [PreguntaController::class, 'destroy'])->name('preguntas.destroy');


    //-----------------------VISTAS ESTUDIANTES---------------------------------------
    Route::get('/estudiante/dashboard', function () {
        return view('VistasEstudiantes.inicio');
    })->name('estudiante.dashboard');
    //Inscripcion a un grupo
    Route::get('/estudiante/inscripcion', [InscripcionController::class, 'inscripcion'])->name('estudiante.inscripcion');
    Route::post('/estudiante/inscripcion/registrar', [InscripcionController::class, 'registrar'])->name('estudiante.inscripcion.registrar');
    //mis materias

    Route::get('/estudiante/materia', function () {
        return view('VistasEstudiantes.materia');
    })->name('estudiante.materia');

    Route::get('/mis-tareas/sprints', [misTareasController::class, 'misTareasPorSprint'])->name('tareas.misTareasPorSprint');
    Route::put('/mis-tareas/{id}', [misTareasController::class, 'edit'])->name('tareas.edit');

    //Vista para crear equipo
    Route::get('/equipo/crear/{grupo}', [EquipoController::class, 'crear'])->name('equipo.crear');
    Route::post('/store/{grupo}', [EquipoController::class, 'store'])->name('equipos.store');
    Route::put('/equipo/{id}/editar', [EquipoController::class, 'update'])->name('equipo.update');
    Route::delete('/equipo/{id}', [EquipoController::class, 'destroy'])->name('equipo.eliminar');
    Route::post('/equipos/{equipo}/agregar-miembro', [EquipoController::class, 'agregarMiembro'])->name('equipos.agregarMiembro');
    Route::post('/equipos/{equipo}/eliminar-miembro', [EquipoController::class, 'eliminarMiembro'])->name('equipos.eliminarMiembro');
    Route::post('/equipos/{equipo}/asignar-rol', [EquipoController::class, 'asignarRol'])->name('equipos.asignarRol');

    //CRUD proyecto
    Route::get('equipos/{equipo}/proyectos', [ProyectosController::class, 'mostrarProyectos'])->name('equipos.proyectos');
    Route::post('/proyectos', [ProyectosController::class, 'store'])->name('proyectos.store');
    Route::put('/proyectos/{id}', [ProyectosController::class, 'update'])->name('proyectos.update');
    Route::delete('/proyectos/{id}', [ProyectosController::class, 'destroy'])->name('proyectos.destroy');

    //Sprint Planner
    Route::get('/sprint-planner', [SprintPlannerController::class, 'index'])
     ->middleware('auth') 
     ->name('sprint-planner');
    Route::post('/sprints', [SprintPlannerController::class, 'store'])->name('sprints.store');
    Route::put('/sprints/{id}', [SprintPlannerController::class, 'update'])->name('sprints.update');
    Route::delete('/sprints/{id}', [SprintPlannerController::class, 'destroy'])->name('sprints.destroy');
    
    //Historia de usuario
    Route::get('/sprints/{id}', [HistoriaUsuarioController::class, 'show'])->name('historias.show');
    Route::post('/historias', [HistoriaUsuarioController::class, 'store'])->name('historias.store');
    Route::put('/historias/{id}', [HistoriaUsuarioController::class, 'update'])->name('historias.update');
    Route::delete('/historias/{id}', [HistoriaUsuarioController::class, 'destroy'])->name('historias.destroy');

    //CRUD Subtares
    Route::post('historias/{historia}/subtareas', [SubtareaController::class, 'store'])->name('subtareas.store');
    Route::put('/subtareas/{id}', [SubtareaController::class, 'update'])->name('subtareas.update');
    Route::delete('/subtareas/{id}', [SubtareaController::class, 'destroy'])->name('subtareas.destroy');



    // Ruta para mostrar el formulario de autoevaluación
    Route::get('/sprints/{sprint}/autoevaluacion', [RespuestaController::class, 'mostrarFormulario'])->name('autoevaluacion.formulario');
    Route::post('/sprints/{sprint}/guardar-respuestas', [RespuestaController::class, 'guardarRespuestas'])->name('guardar_respuestas');





    Route::get('/proyectos/{proyecto}/planificacion', [ProyectosController::class, 'planificacion'])->name('proyectos.planificacion');

  
    




    Route::get('/grupo/{id}', [MateriaController::class, 'mostrar'])->name('grupo.mostrar');
    Route::get('/grupo/menu/{id}', [MateriaController::class, 'materia'])->name('grupo.menu');
});
