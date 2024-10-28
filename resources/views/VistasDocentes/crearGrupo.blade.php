<!-- resources/views/grupos/index.blade.php -->
@extends('layouts.menu')

@section('content')
    <h1>Grupos de Estudiantes</h1>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarGrupo">
        Añadir grupo
    </button>
    <div class="modal fade" id="agregarGrupo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('grupos.store') }}">
                <div class="modal-content">
                    <div class="modal-body">
                        <h2>Crear Grupo</h2>
                        @csrf
                        <div class="form-group">
                            <label for="nombre">Nombre del Grupo</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-success">Crear Grupo</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @foreach ($grupos as $grupo)
    <div class="accordion m-2" id="infoGrupo">
        
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#informacion{{$grupo->id}}" aria-expanded="true" aria-controls="informacion{{$grupo->id}}">
                    {{ $grupo->nombre }}
                </button>
            </h2>
            <div id="informacion{{$grupo->id}}" class="accordion-collapse collapse" data-bs-parent="#infoGrupo">
                <div class="accordion-body">
                    {{$grupo->descripcion}}
                    <p><b>Codigo grupo:</b> {{$grupo->codigo}}</p> 
                    <form action="{{ route('grupo.agregarEstudiante') }}" method="POST" class="d-flex align-items-center mt-3">
                        @csrf
                        <input type="hidden" name="grupo_id" value="{{ $grupo->id }}">
                        <button type="submit" class="btn btn-primary me-2">Agregar miembros</button>
                        <select class="form-select" name="usuario_id" required>
                            <option selected disabled>Selecciona un estudiante</option>
                            @foreach ($usuarios as $usuario)
                                <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                            @endforeach
                        </select>
                    </form>
                    <h5 class="mt-3">Miembros del grupo</h5>
                <ul class="list-group mb-3">
                    @forelse ($grupo->usuarios as $miembro)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $miembro->name }}
                            <span class="badge bg-primary rounded-pill">Estudiante</span>
                        </li>
                    @empty
                        <li class="list-group-item text-muted">No hay estudiantes en este grupo.</li>
                    @endforelse
                </ul>
                </div>
            </div>
        </div>
        
    </div>
    
    @endforeach
@endsection
