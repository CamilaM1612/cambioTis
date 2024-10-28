@extends('layouts.menu')

@section('content')
    <h1>{{ $grupo->nombre }}</h1>
    <p>Descripción: {{ $grupo->descripcion }}</p>

    @if (!$usuarioTieneEquipo)
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crearEquipo">
            Crear Equipo
        </button>
    @endif

    <div class="modal fade m-3" id="crearEquipo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="crearEquipoLabel" aria-hidden="true">
        <form method="POST" action="{{ route('equipos.store', $grupo->id) }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label for="nombre_empresa" class="form-label">Nombre de la Empresa:</label>
                            <input type="text" name="nombre_empresa" id="nombre_empresa" class="form-control"
                                placeholder="Ejemplo S.A." required>
                        </div>

                        <div class="mb-3">
                            <label for="correo_empresa" class="form-label">Correo de la Empresa:</label>
                            <input type="email" name="correo_empresa" id="correo_empresa" class="form-control"
                                placeholder="contacto@ejemplo.com" required>
                        </div>

                        <div class="mb-3">
                            <label for="link_drive" class="form-label">Link de Drive:</label>
                            <input type="url" name="link_drive" id="link_drive" class="form-control"
                                placeholder="https://drive.google.com/..." required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Crear Equipo</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @foreach ($grupo->equipos as $equipo)
        <div class="col-md-12 mb-3">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">{{ $equipo->nombre_empresa }}</h3>
                    <p class="card-text m-0"><strong>Correo:</strong> {{ $equipo->correo_empresa }}</p>
                    <p class="card-text"><strong>Link de Drive:</strong> <a href="{{ $equipo->link_drive }}"
                            target="_blank">Acceder</a></p>

                    <h3>Miembros</h3>
                    <form action="">
                        <select class="form-select" aria-label="Seleccionar estudiante">
                            <option selected>Selecciona un estudiante</option>
                            @foreach ($usuariosEstudiantes as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary mt-2">Agregar miembro</button>
                    </form>

                    <h4 class="mt-4">Lista de Miembros</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Correo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Mostrar solo al creador -->
                            <tr>
                                <td>1</td>
                                <td>{{ $equipo->creador->name }}</td>
                                <td>{{ $equipo->creador->email }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endforeach
@endsection
