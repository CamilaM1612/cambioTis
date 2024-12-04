@extends('layouts.menu')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/estudiante/dashboard">Página principal</a></li>
            <li class="breadcrumb-item"><a href="/estudiante/inscripcion">Inscripcion</a></li>
        </ol>
    </nav>
    <div class="container">
        <h1>Inscripción a Grupos</h1>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row">
            @foreach ($grupos as $grupo)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5>{{ $grupo->nombre }}</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">{{ $grupo->descripcion }}</p>
                            @if ($usuario->gruposAsignados()->where('grupo_id', $grupo->id)->exists())
                                <p class="alert alert-info text-center p-2">Ya estás inscrito en este grupo.</p>
                                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                                    data-bs-target="#crearEquipo">
                                    Crear empresa
                                </button>
                                <div class="modal fade m-3" id="crearEquipo" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="crearEquipoLabel"
                                    aria-hidden="true">
                                    <form method="POST" action="{{ route('equipos.store', $grupo->id) }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="nombre_empresa" class="form-label">Nombre de la
                                                            Empresa:</label>
                                                        <input type="text" name="nombre_empresa" id="nombre_empresa"
                                                            class="form-control" placeholder="Ejemplo S.A." required>

                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="correo_empresa" class="form-label">Correo de la
                                                            Empresa:</label>
                                                        <input type="email" name="correo_empresa" id="correo_empresa"
                                                            class="form-control" placeholder="contacto@ejemplo.com"
                                                            required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="link_drive" class="form-label">Link de Drive:</label>
                                                        <input type="url" name="link_drive" id="link_drive"
                                                            class="form-control" placeholder="https://drive.google.com/..."
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-primary">Crear empresa</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @else
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#inscripcionModal{{ $grupo->id }}">
                                    Unirse
                                </button>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="inscripcionModal{{ $grupo->id }}" tabindex="-1"
                    aria-labelledby="inscripcionModalLabel{{ $grupo->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="inscripcionModalLabel{{ $grupo->id }}">Inscripción al grupo:
                                    {{ $grupo->nombre }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('estudiante.inscripcion.registrar') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="codigo">Código del grupo:</label>
                                        <input type="text" name="codigo" class="form-control" required>
                                    </div>
                                    <input type="hidden" name="grupo_id" value="{{ $grupo->id }}">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Inscribirse</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
        </div>
        @endforeach
    </div>
    </div>
@endsection
