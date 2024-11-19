@extends('layouts.menu')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/docente/dashboard">Página principal</a></li>
            <li class="breadcrumb-item"><a href="/grupos">Grupos</a></li>
            <li class="breadcrumb-item"><a href="{{ route('grupo.avisos', $grupo->id) }}">{{ $grupo->nombre }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('grupo.equipos', $grupo->id) }}"> Equipos</a></li>
            <li class="breadcrumb-item">
                <a href="{{ route('grupo.equipo.informacion', $grupo->id) }}">
                    {{ $grupo->equipos->first()->nombre_empresa }}
                </a>
            </li>

        </ol>
    </nav>
    <div class="container">
        @if ($grupo->equipos->isEmpty())
            <p>No hay equipos en este grupo.</p>
        @else
            @foreach ($grupo->equipos as $equipo)
                <h2>{{ $equipo->nombre_empresa }}</h2>
                <h4>Nota final: {{ $equipo->nota}}</h4>
                <div class="row d-flex justify-content-around mb-3">
                    <div class="col-md-6 border p-3">
                        <h6>Miembros:</h6>
                        <ul>
                            @foreach ($equipo->miembros as $miembro)
                                <li>{{ $miembro->name }} ({{ $miembro->email }})</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-md-5 border p-3">
                        <h6>Parte A</h6>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#parteB{{$equipo->id}}">
                            Ver parte A
                        </button>

                        <div class="modal fade" id="parteB{{$equipo->id}}" tabindex="-1" aria-labelledby="parteB{{$equipo->id}}Label"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                            
                                    <div class="modal-body">
                                        ...
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <h6>Parte B</h6>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#parteB{{$equipo->id}}">
                            Ver parte B
                        </button>

                        <div class="modal fade" id="parteB{{$equipo->id}}" tabindex="-1" aria-labelledby="parteB{{$equipo->id}}Label"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                            
                                    <div class="modal-body">
                                        ...
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <h2>Lista de sprints:</h2>

                @foreach ($equipo->sprints as $sprint)
                    <div class="card mb-3">
                        <div class="card-header">
                            {{ $sprint->nombre }}
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">

                                    <p class="mb-1"> <strong>Objetivo del sprint:</strong> {{ $sprint->objetivo }}</p>
                                    <p class="mb-1"> <strong>Fecha de inicio:</strong> {{ $sprint->fecha_inicio }}</p>
                                    <p class="mb-1"> <strong>Fecha de fin:</strong> {{ $sprint->fecha_fin }}</p>
                                </div>
                                <div class="col-md-6">
                                    
                                        <h4>Nota</h4>
                                        <form action="{{ route('sprint.nota.update', $sprint->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <div class="input-group mb-3">
                                                <input type="number" name="nota" class="form-control" 
                                                       placeholder="Asigna una nota (0-100)" 
                                                       value="{{ $sprint->nota }}" 
                                                       min="0" max="100" step="0.01" required>
                                                <button type="submit" class="btn btn-success">
                                                    <i class="bi bi-save"></i> Guardar
                                                </button>
                                            </div>
                                        </form>
                                    <h4>Comentarios</h4>
                                    @foreach ($sprint->comentarios as $comentario)
                                        <p>{{ $comentario->contenido }} - <small>Por
                                                {{ $comentario->docente->name }}</small>
                                        </p>
                                        <form action="{{ route('comentario.sprint.destroy', $comentario->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash3"></i></button>
                                        </form>
                                    @endforeach
                                    <form action="{{ route('comentarios.storeSprint', $sprint->id) }}" method="POST">
                                        @csrf
                                        <div class="input-group mb-3">
                                            <input type="text" name="contenido" class="form-control"
                                                placeholder="Escribe tu comentario..." required>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="bi bi-send-fill"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <h4>Lista de tareas</h4>
                            @foreach ($sprint->tareas as $tarea)
                                <div class="tareas border mb-3 p-2 bg-success-subtle">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h4><strong>Tarea:</strong> {{ $tarea->titulo }}</h4>
                                            <p><strong>Descripción:</strong> {{ $tarea->descripcion }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><strong>Estado:</strong> {{ $tarea->estado }}</p>
                                            <p><strong>Prioridad:</strong> {{ $tarea->prioridad }}</p>
                                            <p><strong>Fecha de Inicio:</strong> {{ $tarea->fecha_inicio }}</p>
                                            <p><strong>Fecha de Entrega:</strong> {{ $tarea->fecha_entrega }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <h4>Comentarios</h4>
                                        @foreach ($tarea->comentarios as $comentario)
                                            <p>{{ $comentario->contenido }} - <small>Por
                                                    {{ $comentario->docente->name }}</small></p>
                                            <form action="{{ route('comentario.tarea.destroy', $comentario->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash3"></i></button>
                                            </form>
                                        @endforeach

                                        <form action="{{ route('comentarios.storeTarea', $tarea->id) }}" method="POST">
                                            @csrf
                                            <div class="input-group mb-3">
                                                <input type="text" name="contenido" class="form-control"
                                                    placeholder="Escribe tu comentario..." required>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="bi bi-send-fill"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @endforeach
        @endif
    </div>
    @include('layouts.barraBaja')
@endsection
