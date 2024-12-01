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
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Título</th>
        <th scope="col">Descripción</th>
        <th scope="col">Prioridad</th>
        <th scope="col">Estado</th>
        <th scope="col">Acciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($historias as $historia)
        <tr>
          <th scope="row">{{ $historia->id }}</th>
          <td>{{ $historia->titulo }}</td>
          <td>{{ $historia->descripcion }}</td>
          <td>{{ $historia->prioridad }}</td>
          <td>{{ $historia->estado }}</td>
          <td>
            <!-- Botón de editar -->
            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editarHistoriaModal{{ $historia->id }}">
              Editar
            </button>
  
            <!-- Modal para editar -->
            <div class="modal fade" id="editarHistoriaModal{{ $historia->id }}" tabindex="-1" aria-labelledby="editarHistoriaModalLabel{{ $historia->id }}" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editarHistoriaModalLabel{{ $historia->id }}">Editar Historia de Usuario</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form action="{{ route('historias.update', $historia->id) }}" method="POST">
                      @csrf
                      @method('PUT')
  
                      <div class="mb-3">
                        <label for="titulo" class="form-label">Título</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" value="{{ $historia->titulo }}" required>
                      </div>
  
                      <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" required>{{ $historia->descripcion }}</textarea>
                      </div>
  
                      <div class="mb-3">
                        <label for="prioridad" class="form-label">Prioridad</label>
                        <select class="form-select" id="prioridad" name="prioridad" required>
                          <option value="Alta" {{ $historia->prioridad == 'Alta' ? 'selected' : '' }}>Alta</option>
                          <option value="Media" {{ $historia->prioridad == 'Media' ? 'selected' : '' }}>Media</option>
                          <option value="Baja" {{ $historia->prioridad == 'Baja' ? 'selected' : '' }}>Baja</option>
                        </select>
                      </div>
  
                      <div class="mb-3">
                        <label for="estado" class="form-label">Estado</label>
                        <select class="form-select" id="estado" name="estado" required>
                          <option value="Pendiente" {{ $historia->estado == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                          <option value="En progreso" {{ $historia->estado == 'En progreso' ? 'selected' : '' }}>En progreso</option>
                          <option value="Completada" {{ $historia->estado == 'Completada' ? 'selected' : '' }}>Completada</option>
                        </select>
                      </div>
  
                      <div class="mb-3">
                        <label for="criterios_aceptacion" class="form-label">Criterios de Aceptación</label>
                        <textarea class="form-control" id="criterios_aceptacion" name="criterios_aceptacion" required>{{ $historia->criterios_aceptacion }}</textarea>
                      </div>
  
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Actualizar Historia</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
  
            <!-- Botón de eliminar -->
            <form action="{{ route('historias.destroy', $historia->id) }}" method="POST" style="display:inline;">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta historia?')">
                Eliminar
              </button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
  
  
@endsection
