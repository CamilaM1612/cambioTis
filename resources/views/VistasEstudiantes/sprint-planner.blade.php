@extends('layouts.menu')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/estudiante/dashboard">Página principal</a></li>
        <li class="breadcrumb-item"><a href="/sprint-planner">Sprint Planner</a></li>
    </ol>
</nav>
    <div class="container">
        <h1>Mis Proyectos y Sprints</h1>

        @if ($proyectos->isEmpty())
            <p>No tienes proyectos asignados.</p>
        @else
            @foreach ($proyectos as $proyecto)
                <div class="card my-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3>{{ $proyecto->nombre }}</h3>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#crearSprintModal" onclick="setProyectoId({{ $proyecto->id }})">
                            Crear Sprint
                        </button>
                    </div>
                    <p>{{ $proyecto->descripcion }}</p>
                </div>
                    <div class="card-body">
                        @if ($proyecto->sprints->isEmpty())
                            <p>No hay sprints disponibles para este proyecto.</p>
                        @else
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Objetivo</th>
                                    <th>Fecha de Inicio</th>
                                    <th>Fecha de Fin</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($proyecto->sprints as $index => $sprint)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td><a href="{{ route('historias.show', $sprint->id) }}" class="text-decoration-none">
                                            {{ $sprint->nombre }}
                                        </a></td>
                                        
                                        <td>{{ $sprint->objetivo }}</td>
                                        <td>{{ $sprint->fecha_inicio }}</td>
                                        <td>{{ $sprint->fecha_fin }}</td>
                                        <td>
                                            <!-- Botón de eliminar -->
                                            <form action="{{ route('sprints.destroy', $sprint->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" 
                                                    onclick="return confirm('¿Estás seguro de que deseas eliminar este sprint?');">
                                                    <i class="bi bi-trash3"></i> Eliminar
                                                </button>
                                            </form>
                        
                                            <!-- Botón de editar -->
                                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editarSprintModal-{{ $sprint->id }}">
                                                <i class="bi bi-pencil"></i> Editar
                                            </button>
                        
                                            <!-- Modal de editar sprint -->
                                            <div class="modal fade" id="editarSprintModal-{{ $sprint->id }}" tabindex="-1" aria-labelledby="editarSprintModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editarSprintModalLabel">Editar Sprint</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('sprints.update', $sprint->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                        
                                                                <div class="mb-3">
                                                                    <label for="nombre" class="form-label">Nombre del Sprint</label>
                                                                    <input type="text" class="form-control" name="nombre" value="{{ $sprint->nombre }}" required>
                                                                </div>
                        
                                                                <div class="mb-3">
                                                                    <label for="objetivo" class="form-label">Objetivo del Sprint</label>
                                                                    <textarea class="form-control" name="objetivo" required>{{ $sprint->objetivo }}</textarea>
                                                                </div>
                        
                                                                <div class="mb-3">
                                                                    <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                                                                    <input type="date" class="form-control" name="fecha_inicio" value="{{ $sprint->fecha_inicio }}" required>
                                                                </div>
                        
                                                                <div class="mb-3">
                                                                    <label for="fecha_fin" class="form-label">Fecha de Fin</label>
                                                                    <input type="date" class="form-control" name="fecha_fin" value="{{ $sprint->fecha_fin }}" required>
                                                                </div>
                        
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        @endif
                    </div>
                </div>
            @endforeach
            <div class="modal fade" id="crearSprintModal" tabindex="-1" aria-labelledby="crearSprintModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="crearSprintModalLabel">Crear Sprint</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('sprints.store') }}" method="POST">
                                @csrf
                                <!-- Campo oculto para pasar el proyecto_id -->
                                <input type="hidden" id="proyecto-id-input" name="proyecto_id">

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
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary">Crear Sprint</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <script>
        function setProyectoId(proyectoId) {
            document.getElementById('proyecto-id-input').value = proyectoId;
        }
    </script>
    
@endsection
