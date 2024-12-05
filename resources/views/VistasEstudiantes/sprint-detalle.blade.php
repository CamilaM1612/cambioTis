@extends('layouts.menu')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/estudiante/dashboard">Página principal</a></li>
        <li class="breadcrumb-item"><a href="/sprint-planner">Sprint Planner</a></li>
        <li class="breadcrumb-item"><a href="{{ route('historias.show', $sprint->id) }}">{{ $sprint->nombre }}</a></li>
     
    </ol>
</nav>
    <div class="container">
        <h1>Detalles del Sprint</h1>
        <div class="card">
            <div class="card-header">
                {{ $sprint->nombre }}
            </div>
            <div class="card-body">
                <p><strong>Proyecto:</strong> {{ $sprint->proyecto->nombre }}</p>
                <p><strong>Objetivo:</strong> {{ $sprint->objetivo }}</p>
                <p><strong>Fecha de Inicio:</strong> {{ $sprint->fecha_inicio }}</p>
                <p><strong>Fecha de Fin:</strong> {{ $sprint->fecha_fin }}</p>
            </div>
        </div>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crearHistoriaModal">
            Crear Historia de Usuario
        </button>

        <div class="modal fade" id="crearHistoriaModal" tabindex="-1" aria-labelledby="crearHistoriaModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="crearHistoriaModalLabel">Crear Historia de Usuario</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('historias.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="titulo" class="form-label">Título</label>
                                <input type="text" class="form-control" id="titulo" name="titulo" required>
                            </div>
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="prioridad" class="form-label">Prioridad</label>
                                <select class="form-select" id="prioridad" name="prioridad" required>
                                    <option value="Alta">Alta</option>
                                    <option value="Media">Media</option>
                                    <option value="Baja">Baja</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="estado" class="form-label">Estado</label>
                                <select class="form-select" id="estado" name="estado" required>
                                    <option value="Pendiente">Pendiente</option>
                                    <option value="En progreso">En progreso</option>
                                    <option value="Completada">Completada</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="criterios_aceptacion" class="form-label">Criterios de Aceptación</label>
                                <textarea class="form-control" id="criterios_aceptacion" name="criterios_aceptacion" required></textarea>
                            </div>
                            <!-- Sprint ID oculto, ya que se pasa desde el enlace -->
                            <input type="hidden" name="sprints_id" value="{{ $sprint->id }}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Crear Historia</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="mt-4">
            <h2>Historias de Usuario</h2>
            @if ($sprint->historias->isEmpty())
                <p>No hay historias de usuario para este sprint.</p>
            @else
                @foreach ($sprint->historias as $historia)
                    <div class="card mt-3">
                        <div class="card-header">
                            {{ $historia->titulo }}
                            <span class="badge bg-primary">Prioridad: {{ $historia->prioridad }}</span>
                            <span class="badge bg-{{ $historia->estado == 'completado' ? 'success' : 'warning' }}">
                                Estado: {{ ucfirst($historia->estado) }}
                            </span>
                            <div>
                                <!-- Botón para Editar -->
                                <button type="button" class="btn btn-link text-warning" data-bs-toggle="modal"
                                    data-bs-target="#editarHistoriaModal{{ $historia->id }}">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <div class="modal fade" id="editarHistoriaModal{{ $historia->id }}" tabindex="-1"
                                    aria-labelledby="editarHistoriaModalLabel{{ $historia->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editarHistoriaModalLabel{{ $historia->id }}">Editar Historia</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('historias.update', $historia->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3">
                                                        <label for="titulo" class="form-label">Título</label>
                                                        <input type="text" class="form-control" id="titulo" name="titulo"
                                                            value="{{ $historia->titulo }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="descripcion" class="form-label">Descripción</label>
                                                        <textarea class="form-control" id="descripcion" name="descripcion" required>{{ $historia->descripcion }}</textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="prioridad" class="form-label">Prioridad</label>
                                                        <select class="form-control" id="prioridad" name="prioridad" required>
                                                            <option value="Alta" {{ $historia->prioridad == 'Alta' ? 'selected' : '' }}>Alta</option>
                                                            <option value="Media" {{ $historia->prioridad == 'Media' ? 'selected' : '' }}>Media</option>
                                                            <option value="Baja" {{ $historia->prioridad == 'Baja' ? 'selected' : '' }}>Baja</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="estado" class="form-label">Estado</label>
                                                        <select class="form-control" id="estado" name="estado" required>
                                                            <option value="pendiente" {{ $historia->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                                            <option value="en progreso" {{ $historia->estado == 'en progreso' ? 'selected' : '' }}>En Progreso</option>
                                                            <option value="completado" {{ $historia->estado == 'completado' ? 'selected' : '' }}>Completado</option>
                                                        </select>
                                                    </div>
                                                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Botón para Eliminar -->
                                <form action="{{ route('historias.destroy', $historia->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link text-danger"
                                        onclick="return confirm('¿Estás seguro de eliminar esta historia?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <p><strong>Descripción:</strong> {{ $historia->descripcion }}</p>
                            <p><strong>Criterios de Aceptación:</strong> {{ $historia->criterios_aceptacion }}</p>

                            <h5>Subtareas</h5>
                            <button class="btn btn-link text-primary" data-bs-toggle="modal"
                                data-bs-target="#modalSubtarea{{ $historia->id }}">
                                <i class="bi bi-plus-circle"></i> Agregar Subtarea
                            </button>
                            <div class="modal fade" id="modalSubtarea{{ $historia->id }}" tabindex="-1"
                                aria-labelledby="modalSubtareaLabel{{ $historia->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalSubtareaLabel{{ $historia->id }}">Crear
                                                Subtarea
                                                para: {{ $historia->titulo }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('subtareas.store', $historia->id) }}" method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="titulo" class="form-label">Título de la Subtarea</label>
                                                    <input type="text" class="form-control" id="titulo"
                                                        name="titulo" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="descripcion" class="form-label">Descripción</label>
                                                    <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="estado" class="form-label">Estado</label>
                                                    <select class="form-control" id="estado" name="estado" required>
                                                        <option value="Pendiente">Pendiente</option>
                                                        <option value="En Progreso">En Progreso</option>
                                                        <option value="Completada">Completada</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="miembro_asignado" class="form-label">Miembro
                                                        Asignado</label>
                                                    <select class="form-control" id="miembro_asignado"
                                                        name="miembro_asignado" required>
                                                        <option value="">Seleccionar Miembro</option>
                                                        @foreach ($miembros as $miembro)
                                                            <option value="{{ $miembro->id }}">{{ $miembro->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-success">Guardar Subtarea</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if ($historia->subtareas->isEmpty())
                                <p>No hay subtareas asignadas.</p>
                            @else
                                <ul>
                                    @foreach ($historia->subtareas as $subtarea)
                                        <li>
                                            <strong>Título:</strong> {{ $subtarea->titulo }} <br>
                                            <strong>Descripción:</strong> {{ $subtarea->descripcion }} <br>
                                            <strong>Estado:</strong> {{ $subtarea->estado }} <br>
                                            <strong>Asignado a:</strong>
                                            {{ $subtarea->miembroAsignado ? $subtarea->miembroAsignado->name : 'Sin asignar' }}
                                            <form action="{{ route('subtareas.destroy', $subtarea->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link text-danger"
                                                    onclick="return confirm('¿Estás seguro de eliminar esta subtarea?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                            <button type="button" class="btn btn-link text-warning"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editarSubtareaModal{{ $subtarea->id }}">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <div class="modal fade" id="editarSubtareaModal{{ $subtarea->id }}" tabindex="-1"
                                                aria-labelledby="editarSubtareaModalLabel{{ $subtarea->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editarSubtareaModalLabel{{ $subtarea->id }}">
                                                                Editar Subtarea: {{ $subtarea->titulo }}
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('subtareas.update', $subtarea->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="mb-3">
                                                                    <label for="titulo" class="form-label">Título de la Subtarea</label>
                                                                    <input type="text" class="form-control" id="titulo" name="titulo"
                                                                        value="{{ $subtarea->titulo }}" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="descripcion" class="form-label">Descripción</label>
                                                                    <textarea class="form-control" id="descripcion" name="descripcion" required>{{ $subtarea->descripcion }}</textarea>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="estado" class="form-label">Estado</label>
                                                                    <select class="form-control" id="estado" name="estado" required>
                                                                        <option value="Pendiente" {{ $subtarea->estado == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                                                                        <option value="En Progreso" {{ $subtarea->estado == 'En Progreso' ? 'selected' : '' }}>En Progreso</option>
                                                                        <option value="Completada" {{ $subtarea->estado == 'Completada' ? 'selected' : '' }}>Completada</option>
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="miembro_asignado" class="form-label">Miembro Asignado</label>
                                                                    <select class="form-control" id="miembro_asignado" name="miembro_asignado">
                                                                        <option value="">Seleccionar Miembro</option>
                                                                        @foreach ($miembros as $miembro)
                                                                            <option value="{{ $miembro->id }}" 
                                                                                {{ $subtarea->miembroAsignado && $subtarea->miembroAsignado->id == $miembro->id ? 'selected' : '' }}>
                                                                                {{ $miembro->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <button type="submit" class="btn btn-success">Actualizar Subtarea</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            

                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

    </div>
@endsection
