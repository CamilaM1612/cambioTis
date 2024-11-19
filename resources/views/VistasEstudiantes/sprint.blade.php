@extends('layouts.menu')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/estudiante/dashboard">Página principal</a></li>
            <li class="breadcrumb-item"><a href="/mis-equipos">Mis Equipos</a></li>
            <li class="breadcrumb-item">{{ $sprint->equipo->nombre_empresa }}</li>
            <li class="breadcrumb-item"><a href="{{ route('sprints.show', $sprint->id) }}">{{ $sprint->nombre }}</a></li>
        </ol>
    </nav>
    <h1>{{ $sprint->nombre }}</h1>
    @if ($sprintFinalizado || $sprint->tareas->where('usuario_id', Auth::id())->every(fn($tarea) => $tarea->estado === 'Completado'))
    <a href="{{ route('autoevaluaciones.index', $sprint->id) }}" class="btn btn-success">
        Realizar Autoevaluación
    </a>
@endif


    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
        data-bs-target="#crearTareaModal{{ $sprint->id }}">
        Crear Tarea
    </button>

    <div class="container">
        <h1>Tareas del Sprint: {{ $sprint->nombre }}</h1>

        @foreach ($miembros as $miembro)
            <div class="card mb-3">
                <div class="card-header">
                    Tareas asignadas a {{ $miembro->name }}
                </div>
                <div class="card-body">
                    <h4>Progreso</h4>
                    <div class="progress" role="progressbar" style="height: 20px; border-radius:0px"
                        aria-valuenow="{{ $miembro->calcularProgresoPorSprint($sprint->id) }}" aria-valuemin="0"
                        aria-valuemax="100">
                        <div class="progress-bar progress-bar-striped bg-success"
                            style="width: {{ $miembro->calcularProgresoPorSprint($sprint->id) }}%">
                            {{ round($miembro->calcularProgresoPorSprint($sprint->id)) }}%
                        </div>
                    </div>

                    @foreach ($sprint->tareas->where('usuario_id', $miembro->id) as $tarea)
                        <div class="card mb-3">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">{{ $tarea->titulo }}</h5>
                                <div>
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editarTareaModal-{{ $tarea->id }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    
                                    <div class="modal fade" id="editarTareaModal-{{ $tarea->id }}" tabindex="-1" aria-labelledby="editarTareaLabel-{{ $tarea->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editarTareaLabel-{{ $tarea->id }}">Editar Tarea</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('tareas.update', $tarea->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                    
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="titulo" class="form-label">Título de la Tarea</label>
                                                            <input type="text" class="form-control" name="titulo" value="{{ $tarea->titulo }}" required>
                                                        </div>
                                    
                                                        <div class="mb-3">
                                                            <label for="descripcion" class="form-label">Descripción</label>
                                                            <textarea class="form-control" name="descripcion">{{ $tarea->descripcion }}</textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="usuario_id" class="form-label">Miembro Encargado</label>
                                                            <select class="form-select" name="usuario_id">
                                                                <option value="">Seleccionar miembro</option>
                                                                @foreach ($equipo->miembros as $miembro)
                                                                    <option value="{{ $miembro->id }}" {{ $tarea->usuario_id == $miembro->id ? 'selected' : '' }}>
                                                                        {{ $miembro->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="estado" class="form-label">Estado</label>
                                                            <select class="form-select" name="estado" required>
                                                                <option value="Pendiente" {{ $tarea->estado == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                                                                <option value="En Proceso" {{ $tarea->estado == 'En Proceso' ? 'selected' : '' }}>En Proceso</option>
                                                                <option value="Completado" {{ $tarea->estado == 'Completado' ? 'selected' : '' }}>Completado</option>
                                                                <option value="Bloqueado" {{ $tarea->estado == 'Bloqueado' ? 'selected' : '' }}>Bloqueado</option>
                                                                <option value="Revisar" {{ $tarea->estado == 'Revisar' ? 'selected' : '' }}>Revisar</option>
                                                            </select>
                                                        </div>
                                    
                                                        <div class="mb-3">
                                                            <label for="prioridad" class="form-label">Prioridad</label>
                                                            <select class="form-select" name="prioridad" required>
                                                                <option value="Alta" {{ $tarea->prioridad == 'Alta' ? 'selected' : '' }}>Alta</option>
                                                                <option value="Media" {{ $tarea->prioridad == 'Media' ? 'selected' : '' }}>Media</option>
                                                                <option value="Baja" {{ $tarea->prioridad == 'Baja' ? 'selected' : '' }}>Baja</option>
                                                            </select>
                                                        </div>
                                    
                                                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <form action="{{ route('tareas.destroy', $tarea->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('¿Estás seguro de que deseas eliminar esta tarea?')">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <div class="card-body">
                                <p class="mb-1"><strong>Descripción:</strong> {{ $tarea->descripcion }}</p>
                                <div class="d-flex justify-content-between mb-1">
                                    <p class="mb-0">
                                        <strong>Prioridad:</strong>
                                        @if ($tarea->prioridad == 'Alta')
                                            <span class="badge text-bg-danger">Alta</span>
                                        @elseif($tarea->prioridad == 'Media')
                                            <span class="badge text-bg-warning">Media</span>
                                        @elseif($tarea->prioridad == 'Baja')
                                            <span class="badge text-bg-success">Baja</span>
                                        @else
                                            <span class="badge text-bg-secondary">Sin Prioridad</span>
                                        @endif
                                    </p>
                                    <p class="mb-0"><strong>Estado:</strong> {{ $tarea->estado }}</p>
                                </div>

                                <div class="d-flex justify-content-between mb-1">
                                    <p class="mb-0"><strong>Fecha de Inicio:</strong>
                                        {{ \Carbon\Carbon::parse($tarea->fecha_inicio)->format('d \d\e F \d\e Y') }}</p>
                                    <p class="mb-0"><strong>Fecha de Entrega:</strong>
                                        {{ \Carbon\Carbon::parse($tarea->fecha_entrega)->format('d \d\e F \d\e Y') }}</p>
                                </div>
                            </div>
                        </div>

                        
                        
                    @endforeach
                </div>
            </div>
        @endforeach

        <!-- Tareas sin asignar -->
        <div class="card">
            <div class="card-header">
                Tareas sin asignar
            </div>
            <div class="card-body">
                @foreach ($tareasSinAsignar as $tarea)
                    <div class="card mb-3">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">{{ $tarea->titulo }}</h5>
                            <div>
                                <button class="btn btn-warning btn-sm me-2" data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $tarea->id }}">
                                    <i class="bi bi-pencil"></i>
                                </button>

                                <form action="{{ route('tareas.destroy', $tarea->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Estás seguro de que deseas eliminar esta tarea?')">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="card-body">
                            <p class="mb-1"><strong>Descripción:</strong> {{ $tarea->descripcion }}</p>
                            <div class="d-flex justify-content-between mb-1">
                                <p class="mb-0">
                                    <strong>Prioridad:</strong>
                                    @if ($tarea->prioridad == 'Alta')
                                        <span class="badge text-bg-danger">Alta</span>
                                    @elseif($tarea->prioridad == 'Media')
                                        <span class="badge text-bg-warning">Media</span>
                                    @elseif($tarea->prioridad == 'Baja')
                                        <span class="badge text-bg-success">Baja</span>
                                    @else
                                        <span class="badge text-bg-secondary">Sin Prioridad</span>
                                    @endif
                                </p>
                                <p class="mb-0"><strong>Estado:</strong> {{ $tarea->estado }}</p>
                            </div>

                            <div class="d-flex justify-content-between mb-1">
                                <p class="mb-0"><strong>Fecha de Inicio:</strong>
                                    {{ \Carbon\Carbon::parse($tarea->fecha_inicio)->format('d \d\e F \d\e Y') }}</p>
                                <p class="mb-0"><strong>Fecha de Entrega:</strong>
                                    {{ \Carbon\Carbon::parse($tarea->fecha_entrega)->format('d \d\e F \d\e Y') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="editModal{{ $tarea->id }}" tabindex="-1"
                        aria-labelledby="editModalLabel{{ $tarea->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel{{ $tarea->id }}">Editar Tarea
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('tareas.update', $tarea->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="titulo" class="form-label">Título de la Tarea</label>
                                            <input type="text" class="form-control" name="titulo"
                                                value="{{ $tarea->titulo }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="descripcion" class="form-label">Descripción</label>
                                            <textarea class="form-control" name="descripcion" required>{{ $tarea->descripcion }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="usuario_id" class="form-label">Miembro Encargado</label>
                                            <select class="form-select" name="usuario_id">
                                                <option value="">Seleccionar miembro</option>
                                                @foreach ($equipo->miembros as $miembro)
                                                    <option value="{{ $miembro->id }}"
                                                        {{ $tarea->usuario_id == $miembro->id ? 'selected' : '' }}>
                                                        {{ $miembro->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="estado" class="form-label">Estado</label>
                                            <select class="form-select" name="estado" required>
                                                <option value="Pendiente"
                                                    {{ $tarea->estado == 'Pendiente' ? 'selected' : '' }}>Pendiente
                                                </option>
                                                <option value="En Proceso"
                                                    {{ $tarea->estado == 'En Proceso' ? 'selected' : '' }}>En Proceso
                                                </option>
                                                <option value="Completado"
                                                    {{ $tarea->estado == 'Completado' ? 'selected' : '' }}>Completado
                                                </option>
                                                <option value="Bloqueado"
                                                    {{ $tarea->estado == 'Bloqueado' ? 'selected' : '' }}>Bloqueado
                                                </option>
                                                <option value="Revisar"
                                                    {{ $tarea->estado == 'Revisar' ? 'selected' : '' }}>Revisar
                                                </option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="prioridad" class="form-label">Prioridad</label>
                                            <select class="form-select" name="prioridad" required>
                                                <option value="Alta"
                                                    {{ $tarea->prioridad == 'Alta' ? 'selected' : '' }}>Alta</option>
                                                <option value="Media"
                                                    {{ $tarea->prioridad == 'Media' ? 'selected' : '' }}>Media</option>
                                                <option value="Baja"
                                                    {{ $tarea->prioridad == 'Baja' ? 'selected' : '' }}>Baja</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="modal fade" id="crearTareaModal{{ $sprint->id }}" tabindex="-1" aria-labelledby="crearTareaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="crearTareaModalLabel">Nueva tarea para: {{ $sprint->nombre }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('tareas.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="sprint_id" value="{{ $sprint->id }}">


                        <div class="mb-3">
                            <label for="titulo" class="form-label">Título de la
                                Tarea</label>
                            <input type="text" class="form-control" name="titulo" required>
                        </div>

                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" name="descripcion"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="usuario_id" class="form-label">Asignar a</label>
                            <select class="form-control" name="usuario_id">
                                <option value="">Seleccionar miembro</option>

                                @foreach ($equipo->miembros as $miembro)
                                    <option value="{{ $miembro->id }}">{{ $miembro->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select class="form-select" name="estado">
                                <option value="Pendiente">Pendiente</option>
                                <option value="En Proceso">En Proceso</option>
                                <option value="Completado">Completado</option>
                                <option value="Bloqueado">Bloqueado</option>
                                <option value="Revisar">Revisar</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="prioridad" class="form-label">Prioridad</label>
                            <select class="form-select" name="prioridad">
                                <option value="Alta">Alta</option>
                                <option value="Media">Media</option>
                                <option value="Baja">Baja</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="fecha_inicio" class="form-label">Fecha de
                                Inicio</label>
                            <input type="date" class="form-control" name="fecha_inicio">
                        </div>

                        <div class="mb-3">
                            <label for="fecha_entrega" class="form-label">Fecha de
                                Entrega</label>
                            <input type="date" class="form-control" name="fecha_entrega">
                        </div>
                        <button type="submit" class="btn btn-success">Crear tarea</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

