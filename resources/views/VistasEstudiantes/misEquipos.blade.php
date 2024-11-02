@extends('layouts.menu')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/estudiante/dashboard">Página principal</a></li>
      <li class="breadcrumb-item"><a href="/mis-equipos">Mis Equipos</a></li>
    </ol>
  </nav>
    <h2>Mis Equipos</h2>

    <div class="equipos-list">
        @foreach ($equipos as $equipo)
            <div class="equipo-item border rounded p-3 mb-3">
                <h3>{{ $equipo->nombre_empresa }}</h3>
                <p><strong>Correo electrónico:</strong> {{ $equipo->correo_empresa }}</p>
    
                @if ($equipo->grupo)
                    <p><strong>Grupo:</strong> {{ $equipo->grupo->nombre }}</p>
                @else
                    <p>Este equipo no está asignado a ningún grupo.</p>
                @endif
    
                <h4>Integrantes:</h4>
                @if ($equipo->miembros->isEmpty())
                    <p>No hay miembros en este equipo.</p>
                @else
                    <ul>
                        @foreach ($equipo->miembros as $miembro)
                            <li>{{ $miembro->name }}</li>
                        @endforeach
                    </ul>
                @endif
    
                <h4>Sprints:</h4>
                <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal"
                    data-bs-target="#crearSprintModal{{ $equipo->id }}">
                    Crear Sprint
                </button>
                @if ($equipo->sprints->isEmpty())
                    <p>No hay sprints para este equipo.</p>
                @else
                    <div class="list-group mt-2">
                        @foreach ($equipo->sprints as $sprint)
                            <div class="list-group-item mb-2">
                                <a href="{{ route('sprints.show', $sprint->id) }}" class="text-decoration-none">
                                    <h5 class="mb-1">{{ $sprint->nombre }}</h5>
                                </a>
                                <p class="mb-1"><strong>Objetivo:</strong> {{ $sprint->objetivo }}</p>
                                <p class="mb-1"><strong>Fecha de Inicio:</strong> {{ $sprint->fecha_inicio }}</p>
                                <p class="mb-1"><strong>Fecha de Fin:</strong> {{ $sprint->fecha_fin }}</p>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editarSprintModal-{{ $sprint->id }}">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <form action="{{ route('sprints.destroy', $sprint->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('¿Estás seguro de que deseas eliminar este sprint?');">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
    
                            <!-- Modal para editar Sprint -->
                            <div class="modal fade" id="editarSprintModal-{{ $sprint->id }}" tabindex="-1"
                                aria-labelledby="editarSprintModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <form action="{{ route('sprints.update', $sprint->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
    
                                                <div class="mb-3">
                                                    <label for="nombre" class="form-label">Nombre del
                                                        Sprint</label>
                                                    <input type="text" class="form-control" name="nombre"
                                                        value="{{ $sprint->nombre }}" required>
                                                </div>
    
                                                <div class="mb-3">
                                                    <label for="objetivo" class="form-label">Objetivo del
                                                        Sprint</label>
                                                    <textarea class="form-control" name="objetivo" required>{{ $sprint->objetivo }}</textarea>
                                                </div>
    
                                                <div class="mb-3">
                                                    <label for="fecha_inicio" class="form-label">Fecha de
                                                        Inicio</label>
                                                    <input type="date" class="form-control"
                                                        name="fecha_inicio" value="{{ $sprint->fecha_inicio }}"
                                                        required>
                                                </div>
    
                                                <div class="mb-3">
                                                    <label for="fecha_fin" class="form-label">Fecha de Fin</label>
                                                    <input type="date" class="form-control" name="fecha_fin"
                                                        value="{{ $sprint->fecha_fin }}" required>
                                                </div>
    
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-primary">Guardar
                                                        Cambios</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
    
                <!-- Modal para crear Sprint -->
                <div class="modal fade" id="crearSprintModal{{ $equipo->id }}" tabindex="-1"
                    aria-labelledby="crearSprintModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="crearSprintModalLabel">Crear Sprint para
                                    {{ $equipo->nombre_empresa }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('sprints.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="equipo_id" value="{{ $equipo->id }}">
    
                                    <div class="mb-3">
                                        <label for="nombre" class="form-label">Nombre del Sprint</label>
                                        <input type="text" class="form-control" name="nombre" required>
                                    </div>
    
                                    <div class="mb-3">
                                        <label for="objetivo" class="form-label">Objetivo del Sprint</label>
                                        <textarea class="form-control" name="objetivo"></textarea>
                                    </div>
    
                                    <div class="mb-3">
                                        <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                                        <input type="date" class="form-control" name="fecha_inicio" required>
                                    </div>
    
                                    <div class="mb-3">
                                        <label for="fecha_fin" class="form-label">Fecha de Fin</label>
                                        <input type="date" class="form-control" name="fecha_fin" required>
                                    </div>
    
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary">Crear Sprint</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
@endsection
