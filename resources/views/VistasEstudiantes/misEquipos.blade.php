@extends('layouts.menu')

@section('content')
    <style>
        .informacion-equipo {
            display: flex;
            flex-direction: row;
            justify-content: space-around;
            margin-bottom: 2%;
        }

        .datos-equipo {
            border: 1px solid rgb(138, 138, 138);
            width: 45%;
            border-radius: 10px;
            padding: 1% 2%;
        }

        p {
            margin-bottom: 3px;
        }
    </style>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/estudiante/dashboard">Página principal</a></li>
            <li class="breadcrumb-item"><a href="/mis-equipos">Mis Equipos</a></li>
        </ol>
    </nav>
    <h2>Mis Equipos</h2>


    @foreach ($equipos as $equipo)
        <div class="equipo-item border rounded p-4 mb-3">
            <h3>{{ $equipo->nombre_empresa }}</h3>
            <div class="row informacion-equipo">
                <div class="datos-equipo">
                    <p><strong>Correo electrónico:</strong> {{ $equipo->correo_empresa }}</p>

                    @if ($equipo->grupo)
                        <p><strong>Grupo:</strong> {{ $equipo->grupo->nombre }}</p>
                    @else
                        <p>Este equipo no está asignado a ningún grupo.</p>
                    @endif
                </div>
                <div class="datos-equipo">
                    <h4>Integrantes:</h4>
                    @if ($equipo->miembros->isEmpty())
                        <p>No hay miembros en este equipo.</p>
                    @else
                        <ol>
                            @foreach ($equipo->miembros as $miembro)
                                <li>{{ $miembro->name }}</li>
                            @endforeach
                        </ol>
                    @endif
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>Lista de sprints:</h4>

                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                    data-bs-target="#crearSprintModal{{ $equipo->id }}">
                    <i class="bi bi-plus-circle"></i> Crear Sprint
                </button>
            </div>

            @if ($equipo->sprints->isEmpty())
                <p>No hay sprints para este equipo.</p>
            @else
                <div class="list-group mt-2">
                    @foreach ($equipo->sprints as $sprint)
                        <div class="list-group-item mb-2 bg-primary-subtle p-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <a href="{{ route('sprints.show', $sprint->id) }}" class="text-decoration-none">
                                    <h5 class="mb-1">{{ $sprint->nombre }}</h5>
                                </a>

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

                            <p class="mb-1 "><strong>Objetivo:</strong> {{ $sprint->objetivo }}</p>
                            <div class="row">
                                <div class="col d-flex justify-content-start">
                                    <span class="mb-1"><strong>Fecha de Inicio:</strong>
                                        {{ $sprint->fecha_inicio }}</span>
                                </div>
                                <div class="col d-flex justify-content-end">
                                    <span class="mb-1"><strong>Fecha de Fin:</strong> {{ $sprint->fecha_fin }}</span>
                                </div>
                                @if (\Carbon\Carbon::now()->greaterThanOrEqualTo($sprint->fecha_fin))
                                    <span class="badge bg-danger ms-2">Sprint terminado</span>
                                @else
                                    <span class="badge bg-success ms-2">En curso</span>
                                @endif
                            </div>


                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div>
                                    @if ($sprint->nota !== null)
                                        <p class="mb-0"><strong>Nota: </strong>{{ $sprint->nota }} / 100</p>
                                    @else
                                        <p class="mb-0"><strong>Nota: </strong>Por calificar</p>
                                    @endif
                                </div>
                                <span class="badge {{ $sprint->nota !== null ? 'bg-success' : 'bg-warning text-dark' }}">
                                    {{ $sprint->nota !== null ? 'Calificado' : 'Pendiente' }}
                                </span>
                            </div>
                            


                            @foreach ($sprint->comentarios as $comentario)
                                <div class="card mb-2">
                                    <div class="card-body">
                                        <h6 class="card-title">
                                            <strong>Comentario de:</strong>
                                            {{ $comentario->docente->name ?? 'Desconocido' }}
                                        </h6>

                                        <p class="text-muted mb-1">
                                            <small>Fecha: {{ $comentario->created_at->format('d/m/Y H:i') }}</small>
                                        </p>

                                        <p class="card-text">{{ $comentario->contenido }}</p>
                                    </div>
                                </div>
                            @endforeach


                        </div>

                        <div class="modal fade" id="editarSprintModal-{{ $sprint->id }}" tabindex="-1"
                            aria-labelledby="editarSprintModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <form action="{{ route('sprints.update', $sprint->id) }}" method="POST">
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
                                                <input type="date" class="form-control" name="fecha_inicio"
                                                    value="{{ $sprint->fecha_inicio }}" required>
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
@endsection
