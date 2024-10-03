@extends('layouts.menu')

@section('content')
    <div class="container mt-4">
        <h2 class="text-center">Lista de Usuarios Registrados</h2>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary m-3" data-bs-toggle="modal" data-bs-target="#registroUsuario">
            <i class="bi bi-person-plus"></i>Añadir usuario
        </button>

        <!-- Modal -->
        <div class="modal fade" id="registroUsuario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="registroUsuarioLabel" aria-hidden="true">
            <form method="POST" action="{{ route('usuarios.store') }}">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-body">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Nombre</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                                        <input id="name" class="form-control" type="text" name="name" required
                                            autofocus autocomplete="name">
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Correo Electrónico</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                        <input id="email" class="form-control" type="email" name="email" required>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label">Contraseña</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                        <input id="password" class="form-control" type="password" name="password" required
                                            autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                        <input id="password_confirmation" class="form-control" type="password"
                                            name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="role_id" class="form-label">Seleccionar Rol</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                                        <select id="role_id" name="role_id" class="form-select" required>
                                            @foreach ($roles as $rol)
                                                <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Número de Teléfono</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                        <input id="phone" class="form-control" type="tel" name="phone"
                                            pattern="[0-9]{8,15}" placeholder="Ingrese un número válido" required>
                                    </div>
                                    <small class="form-text text-muted">Debe contener entre 8 y 15 dígitos</small>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary"> <i class="bi bi-person-plus"></i>
                                Registrar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>


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
                                                <select class="form-select" id="role_id{{ $usuario->id }}"
                                                    name="role_id" required>
                                                    @foreach ($roles as $rol)
                                                        <option value="{{ $rol->id }}"
                                                            {{ $rol->id == $usuario->role_id ? 'selected' : '' }}>
                                                            {{ $rol->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="estado{{ $usuario->id }}" class="form-label">Estado</label>
                                                <select class="form-select" id="estado{{ $usuario->id }}"
                                                    name="estado">
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