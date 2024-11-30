@extends('layouts.menu')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/estudiante/dashboard">Página principal</a></li>
        <li class="breadcrumb-item">Mis materias</li>
        <li class="breadcrumb-item"><a href="{{ route('grupo.mostrar', $grupo->id) }}">{{ $grupo->nombre }}</a></li>
        <li class="breadcrumb-item">Crear equipo</li>
    </ol>
</nav>
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#crearEquipo">
    Crear Equipo
     </button>

     @if($errors->has('nombre_empresa'))
     <div class="alert alert-danger p-1 text-center" role="alert">
         <span>{{ $errors->first('nombre_empresa') }}</span>
     </div>
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
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="card-title text-center mb-0">{{ $equipo->nombre_empresa }}</h3>
                    <div>
                        <form action="{{ route('equipo.eliminar', $equipo->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que quieres eliminar este equipo?');">
                                <i class="bi bi-trash3"></i>
                            </button>
                        </form>
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editarEquipoModal-{{ $equipo->id }}">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                    </div>
                </div>
                
                <div class="modal fade" id="editarEquipoModal-{{ $equipo->id }}" tabindex="-1" aria-labelledby="editarEquipoLabel-{{ $equipo->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editarEquipoLabel-{{ $equipo->id }}">Editar Equipo</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('equipo.update', $equipo->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="nombre_empresa" class="form-label">Nombre de la Empresa</label>
                                        <input type="text" class="form-control" name="nombre_empresa" value="{{ $equipo->nombre_empresa }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="correo_empresa" class="form-label">Correo de la Empresa</label>
                                        <input type="email" class="form-control" name="correo_empresa" value="{{ $equipo->correo_empresa }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="link_drive" class="form-label">Link de Drive</label>
                                        <input type="url" class="form-control" name="link_drive" value="{{ $equipo->link_drive }}" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
    
                <p class="card-text m-0"><strong>Correo:</strong> {{ $equipo->correo_empresa }}</p>
                <p class="card-text"><strong>Link de Drive:</strong> <a href="{{ $equipo->link_drive }}" target="_blank">Acceder</a></p>
                
                <div class="col-md-6">
                    <h4 class="mt-4">Lista de Miembros</h4>
                    <ul class="list-group">
                        @foreach ($equipo->miembros as $miembro)
                            <li class="list-group-item">
                                <i class="bi bi-person-fill"></i> {{ $miembro->name }} - {{ $miembro->email }}
                            </li>
                        @endforeach
                    </ul>
    
                    <!-- Formulario para añadir nuevo miembro -->
                    <form action="{{ route('equipos.agregarMiembro', ['equipo' => $equipo->id]) }}" method="POST" class="mt-3">
                        @csrf
                        <div class="mb-3 d-flex align-items-center">
                            <select class="form-select me-2" name="usuario_id" required style="width: auto; min-width: 150px;">
                                <option selected disabled>Selecciona un estudiante</option>
                                @foreach ($usuariosSinEquipo as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary" style="padding: 0.3rem 0.5rem;">Agregar miembro</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    
@endforeach

@endsection