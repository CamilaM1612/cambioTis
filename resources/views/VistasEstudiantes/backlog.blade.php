@extends('layouts.menu')

@section('content')
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crearHistoriaModal">
    Crear Historia de Usuario
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="crearHistoriaModal" tabindex="-1" aria-labelledby="crearHistoriaModalLabel" aria-hidden="true">
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
            <input type="hidden" name="sprint_id" value="{{ $sprint->id }}">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Crear Historia</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  <div class="container mt-4">
    <div class="row">
      @foreach ($historias as $historia)
        <div class="col-md-12 mb-4">
          <!-- Contenedor rectangular para la Historia -->
          <div class="d-flex flex-column p-3 border rounded-3 shadow-sm">
            <div class="d-flex justify-content-between align-items-center">
              <!-- Título de la historia -->
              <div>
                <h5 class="m-0">{{ $historia->titulo }}</h5>
                <p class="text-muted mb-0">{{ $historia->descripcion }}</p>
              </div>
  
              <!-- Botones de Editar y Eliminar -->
              <div class="d-flex">
                <button type="button" class="btn btn-link btn-sm text-warning" data-bs-toggle="modal" data-bs-target="#editarHistoriaModal{{ $historia->id }}">
                  <i class="bi bi-pencil"></i>
                </button>
                <form action="{{ route('historias.destroy', $historia->id) }}" method="POST" style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-link btn-sm text-danger" onclick="return confirm('¿Estás seguro de eliminar esta historia?')">
                    <i class="bi bi-trash"></i>
                  </button>
                </form>
              </div>
            </div>
  
            <!-- Prioridad y Estado -->
            <div class="d-flex justify-content-between mt-2">
              <p><strong>Prioridad:</strong> {{ $historia->prioridad }}</p>
              <p><strong>Estado:</strong> {{ $historia->estado }}</p>
            </div>
  
            <!-- Botones de Ver Subtareas y Agregar Subtarea en la misma fila -->
            <div class="d-flex justify-content-between align-items-center mt-3">
              <!-- Botón para Ver Subtareas -->
              <button class="btn btn-link text-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#subtareas{{ $historia->id }}" aria-expanded="false" aria-controls="subtareas{{ $historia->id }}">
                <i class="bi bi-eye"></i> Ver Subtareas
              </button>
  
              <!-- Botón para Agregar Subtarea -->
              <button class="btn btn-link text-primary" data-bs-toggle="modal" data-bs-target="#modalSubtarea{{ $historia->id }}">
                <i class="bi bi-plus-circle"></i> Agregar Subtarea
              </button>
            </div>
  
            <!-- Modal para Agregar Subtarea -->
            <div class="modal fade" id="modalSubtarea{{ $historia->id }}" tabindex="-1" aria-labelledby="modalSubtareaLabel{{ $historia->id }}" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="modalSubtareaLabel{{ $historia->id }}">Crear Subtarea para: {{ $historia->titulo }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form action="{{ route('subtareas.store', $historia->id) }}" method="POST">
                      @csrf
                      <div class="mb-3">
                        <label for="titulo" class="form-label">Título de la Subtarea</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" required>
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
                        <label for="miembro_asignado" class="form-label">Miembro Asignado</label>
                        <select class="form-control" id="miembro_asignado" name="miembro_asignado" required>
                          <option value="">Seleccionar Miembro</option>
                          @foreach ($miembros as $miembro)
                            <option value="{{ $miembro->id }}">{{ $miembro->name }}</option>
                          @endforeach
                        </select>
                      </div>
                      <button type="submit" class="btn btn-success">Guardar Subtarea</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
  
            @if($historia->subtareas->count() > 0)
  <div class="mt-3">
    <div class="collapse mt-3" id="subtareas{{ $historia->id }}">
      <ul class="list-group">
        @foreach ($historia->subtareas as $subtarea)
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div>
              <strong>{{ $subtarea->titulo }}</strong>
              <p><strong>Descripción:</strong> {{ $subtarea->descripcion }}</p>
              <span class="badge bg-primary">{{ $subtarea->estado }}</span>
              @if ($subtarea->miembroAsignado)
                <p class="mt-2"><strong>Miembro Asignado:</strong> {{ $subtarea->miembroAsignado->name }}</p>
              @else
                <p class="mt-2 text-muted">No asignado</p>
              @endif
            </div>
            <div class="d-flex">
              <!-- Botón para Editar -->
              <button type="button" class="btn btn-link text-warning" data-bs-toggle="modal" data-bs-target="#editarSubtareaModal{{ $subtarea->id }}">
                <i class="bi bi-pencil"></i>
              </button>

              <!-- Botón para Eliminar -->
              <form action="{{ route('subtareas.destroy', $subtarea->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-link text-danger" onclick="return confirm('¿Estás seguro de eliminar esta subtarea?')">
                  <i class="bi bi-trash"></i>
                </button>
              </form>
            </div>
          </li>

          <!-- Modal para Editar Subtarea -->
          <div class="modal fade" id="editarSubtareaModal{{ $subtarea->id }}" tabindex="-1" aria-labelledby="editarSubtareaModalLabel{{ $subtarea->id }}" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="editarSubtareaModalLabel{{ $subtarea->id }}">Editar Subtarea: {{ $subtarea->titulo }}</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="{{ route('subtareas.update', $subtarea->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                      <label for="titulo" class="form-label">Título de la Subtarea</label>
                      <input type="text" class="form-control" id="titulo" name="titulo" value="{{ $subtarea->titulo }}" required>
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
                          <option value="{{ $miembro->id }}" {{ $subtarea->miembroAsignado && $subtarea->miembroAsignado->id == $miembro->id ? 'selected' : '' }}>
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

        @endforeach
      </ul>
    </div>
  </div>
@endif

          </div>
        </div>
      @endforeach
    </div>
  </div>
  
  
  
@endsection
