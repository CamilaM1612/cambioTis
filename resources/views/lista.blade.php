@extends('componentes.menu')

@section('content')
    <a href="/register">Registra</a>
    <div class="container mt-4">
        <h2 class="text-center">Lista de Usuarios Registrados</h2>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Correo Electrónico</th>
                        <th>Rol</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->name }}</td>
                            <td>{{ $usuario->email }}</td>
                            <td>{{ $usuario->rol->name }}</td>
                            <!-- Aquí no hay verificación, ya que no debe ser nulo -->
                            <td>
                                @if ($usuario->estado)
                                    <span class="badge bg-success">Activo</span>
                                @else
                                    <span class="badge bg-secondary">Desactivado</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" title="Eliminar"
                                        onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?')">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $usuario->id }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                            </td>
                        </tr>
                        <div class="modal fade" id="editModal{{ $usuario->id }}" tabindex="-1"
                            aria-labelledby="editModalLabel{{ $usuario->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{ $usuario->id }}">Editar Usuario
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label for="name{{ $usuario->id }}" class="form-label">Nombre</label>
                                                <input type="text" class="form-control" id="name{{ $usuario->id }}"
                                                    name="name" value="{{ $usuario->name }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="email{{ $usuario->id }}" class="form-label">Correo
                                                    Electrónico</label>
                                                <input type="email" class="form-control" id="email{{ $usuario->id }}"
                                                    name="email" value="{{ $usuario->email }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="role_id{{ $usuario->id }}" class="form-label">Rol</label>
                                                <select class="form-select" id="role_id{{ $usuario->id }}" name="role_id"
                                                    required>
                                                    @foreach ($roles as $rol)
                                                        <option value="{{ $rol->id }}"
                                                            {{ $rol->id == $usuario->role_id ? 'selected' : '' }}>
                                                            {{ $rol->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="estado{{ $usuario->id }}" class="form-label">Estado</label>
                                                <select class="form-select" id="estado{{ $usuario->id }}" name="estado">
                                                    <option value="1" {{ $usuario->estado ? 'selected' : '' }}>
                                                        Activo</option>
                                                    <option value="0" {{ !$usuario->estado ? 'selected' : '' }}>
                                                        Desactivado</option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
