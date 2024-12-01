@extends('layouts.menu')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/estudiante/dashboard">Página principal</a></li>
            <li class="breadcrumb-item"><a href="/mis-equipos">Mis Equipos</a></li>
        </ol>
    </nav>

    <h2>Historias de Usuario para el Equipo: {{ $equipo->nombre_empresa }}</h2>

    <!-- Botón para abrir el modal -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createHistoriaModal">
        Crear Historia de Usuario
    </button>

    <div class="row">
        @foreach ($historias as $historia)
            <div class="col-md-4 mb-4">
                <!-- Caja para cada historia de usuario -->
                <div class="card">
                    <!-- Encabezado: título y botones -->
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">{{ $historia->titulo }}</h5>
                        <div>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target="#editHistoriaModal{{ $historia->id }}" title="Editar">
                                <i class="bi bi-pencil"></i>
                            </button>

                            <form action="{{ route('historias.destroy', $historia->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Eliminar">
                                    <i class="bi bi-trash"></i> <!-- Icono de eliminar -->
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Descripción de la historia -->
                    <div class="card-body">
                        <p class="card-text">{{ $historia->descripcion }}</p>

                        <!-- Línea separadora -->
                        <hr>

                        <!-- Criterios de aceptación -->
                        <h6>Criterios de Aceptación</h6>
                        <p>{{ $historia->criterios_aceptacion }}</p>

                        <!-- Línea separadora -->
                        <hr>

                        <!-- Prioridad y estado -->
                        <div class="d-flex justify-content-between">
                            <span><strong>Prioridad:</strong> {{ ucfirst($historia->prioridad) }}</span>
                            <span><strong>Estado:</strong> {{ ucfirst($historia->estado) }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="editHistoriaModal{{ $historia->id }}" tabindex="-1"
                aria-labelledby="editHistoriaModalLabel{{ $historia->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editHistoriaModalLabel{{ $historia->id }}">Editar Historia de
                                Usuario</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('historias.update', $historia->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <!-- Título -->
                                <div class="mb-3">
                                    <label for="titulo" class="form-label">Título</label>
                                    <input type="text" class="form-control" id="titulo" name="titulo"
                                        value="{{ $historia->titulo }}" required>
                                </div>

                                <!-- Descripción -->
                                <div class="mb-3">
                                    <label for="descripcion" class="form-label">Descripción</label>
                                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required>{{ $historia->descripcion }}</textarea>
                                </div>

                                <!-- Criterios de Aceptación -->
                                <div class="mb-3">
                                    <label for="criterios_aceptacion" class="form-label">Criterios de Aceptación</label>
                                    <textarea class="form-control" id="criterios_aceptacion" name="criterios_aceptacion" rows="3">{{ $historia->criterios_aceptacion }}</textarea>
                                </div>

                                <!-- Prioridad -->
                                <div class="mb-3">
                                    <label for="prioridad" class="form-label">Prioridad</label>
                                    <select class="form-select" id="prioridad" name="prioridad" required>
                                        <option value="baja" {{ $historia->prioridad == 'baja' ? 'selected' : '' }}>Baja
                                        </option>
                                        <option value="media" {{ $historia->prioridad == 'media' ? 'selected' : '' }}>
                                            Media</option>
                                        <option value="alta" {{ $historia->prioridad == 'alta' ? 'selected' : '' }}>Alta
                                        </option>
                                    </select>
                                </div>

                                <!-- Estado -->
                                <div class="mb-3">
                                    <label for="estado" class="form-label">Estado</label>
                                    <select class="form-select" id="estado" name="estado" required>
                                        <option value="pendiente" {{ $historia->estado == 'pendiente' ? 'selected' : '' }}>
                                            Pendiente</option>
                                        <option value="en progreso"
                                            {{ $historia->estado == 'en progreso' ? 'selected' : '' }}>En progreso</option>
                                        <option value="completada"
                                            {{ $historia->estado == 'completada' ? 'selected' : '' }}>Completada</option>
                                    </select>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="modal fade" id="createHistoriaModal" tabindex="-1" aria-labelledby="createHistoriaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createHistoriaModalLabel">Nueva Historia de Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('historias.store', $equipo->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="titulo" class="form-label">Título</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" required>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea name="descripcion" id="descripcion" class="form-control" rows="4" required>Yo como [rol], quiero [acción o funcionalidad], para [beneficio o propósito].</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="prioridad" class="form-label">Prioridad</label>
                            <select class="form-control" id="prioridad" name="prioridad" required>
                                <option value="baja">Baja</option>
                                <option value="media">Media</option>
                                <option value="alta">Alta</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select class="form-control" id="estado" name="estado" required>
                                <option value="pendiente">Pendiente</option>
                                <option value="en progreso">En progreso</option>
                                <option value="completada">Completada</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="criterios_aceptacion" class="form-label">Criterios de Aceptación</label>
                            <textarea class="form-control" id="criterios_aceptacion" name="criterios_aceptacion"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Crear Historia</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
