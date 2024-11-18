@extends('layouts.menu')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/docente/dashboard">Página principal</a></li>
            <li class="breadcrumb-item"><a href="/grupos">Grupos</a></li>
            <li class="breadcrumb-item"><a href="{{ route('grupo.avisos', $grupo->id) }}">{{ $grupo->nombre }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('grupo.evaluaciones', $grupo->id) }}"> Evaluaciones</a></li>
        </ol>
    </nav>

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createEvaluationModal">
        Crear Evaluación
    </button>

    <div class="modal fade" id="createEvaluationModal" tabindex="-1" aria-labelledby="createEvaluationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createEvaluationModalLabel">Crear Evaluación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('evaluacion.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="titulo" class="form-label">Título de la Evaluación</label>
                            <input type="text" class="form-control" id="titulo" name="titulo"
                                placeholder="Ingrese el título de la evaluación" required>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3"
                                placeholder="Ingrese la descripción de la evaluación" required></textarea>
                        </div>
                        <input type="hidden" name="grupo_id" value="{{ $grupo->id }}">
                        <button type="submit" class="btn btn-primary">Crear Evaluación</button>

                    </form>
                </div>
            </div>
        </div>
    </div>


    @foreach ($grupo->evaluaciones as $evaluacion)
        <div class="container border p-3 m-2">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{ $evaluacion->id }}">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $evaluacion->id }}" aria-expanded="true" aria-controls="collapse{{ $evaluacion->id }}">
                            {{ $evaluacion->titulo }}
                        </button>
                    </h2>
                    <div id="collapse{{ $evaluacion->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $evaluacion->id }}" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            {{-- <a href="{{ route('evaluacion.preguntas', $evaluacion->id) }}" class="text-decoration-none">
                                Ver Preguntas
                            </a> --}}
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crearPreguntaModal">
                                Agregar Pregunta
                            </button>
                        
                            <div class="modal fade" id="crearPreguntaModal" tabindex="-1" aria-labelledby="crearPreguntaModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="crearPreguntaModalLabel">Agregar Nueva Pregunta</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('preguntas.store') }}" method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="pregunta" class="form-label">Contenido de la Pregunta</label>
                                                    <input type="text" class="form-control" id="pregunta" name="pregunta" required>
                                                </div>
                        
                                                <div class="mb-3">
                                                    <label for="max_escala" class="form-label">Máximo de la Escala</label>
                                                    <select class="form-control" id="max_escala" name="max_escala">
                                                        @for ($i = 5; $i <= 10; $i++)
                                                            <option value="{{ $i }}">{{ $i }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                        
                                                <input type="hidden" name="evaluacion_id" value="{{ $evaluacion->id }}">
                                                <button type="submit" class="btn btn-primary">Agregar Pregunta</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h4>Preguntas</h4>
                            @foreach ($evaluacion->preguntas as $pregunta)
                                <div class="mb-3 border p-3">
                                    <h5>{{ $pregunta->pregunta }}</h5>
                                    <p>Escala (1 - {{ $pregunta->max_escala }}):</p>
                                    @for ($i = 1; $i <= $pregunta->max_escala; $i++)
                                        <button type="button" class="btn btn-outline-primary btn-sm">{{ $i }}</button>
                                    @endfor
                                    <!-- Botón para abrir el modal de edición -->
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#editarPreguntaModal{{ $pregunta->id }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                        
                                    <!-- Modal de edición -->
                                    <div class="modal fade" id="editarPreguntaModal{{ $pregunta->id }}" tabindex="-1"
                                        aria-labelledby="editarPreguntaModalLabel{{ $pregunta->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editarPreguntaModalLabel{{ $pregunta->id }}">Editar Pregunta</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('preguntas.update', $pregunta->id) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <div class="mb-3">
                                                            <label for="pregunta" class="form-label">Contenido de la Pregunta</label>
                                                            <input type="text" class="form-control" name="pregunta"
                                                                value="{{ $pregunta->pregunta }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="max_escala" class="form-label">Máximo de la Escala</label>
                                                            <select class="form-control" name="max_escala">
                                                                @for ($i = 5; $i <= 10; $i++)
                                                                    <option value="{{ $i }}"
                                                                        {{ $pregunta->max_escala == $i ? 'selected' : '' }}>{{ $i }}
                                                                    </option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Actualizar</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        
                                    <!-- Botón de eliminación -->
                                    <form action="{{ route('preguntas.destroy', $pregunta->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('¿Estás seguro de que deseas eliminar esta pregunta?')">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            

            <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                data-bs-target="#editEvaluationModal{{ $evaluacion->id }}">
                <i class="bi bi-pencil-square"></i>
            </button>

            <!-- Modal de edición de evaluación -->
            <div class="modal fade" id="editEvaluationModal{{ $evaluacion->id }}" tabindex="-1"
                aria-labelledby="editEvaluationModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editEvaluationModalLabel">Editar Evaluación</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('evaluacion.update', $evaluacion->id) }}" method="POST">
                                @csrf
                                @method('PUT') <!-- Indica que es una solicitud PUT -->
                                <div class="mb-3">
                                    <label for="titulo" class="form-label">Título de la Evaluación</label>
                                    <input type="text" class="form-control" id="titulo" name="titulo"
                                        value="{{ $evaluacion->titulo }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="descripcion" class="form-label">Descripción</label>
                                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required>{{ $evaluacion->descripcion }}</textarea>
                                </div>
                                <input type="hidden" name="grupo_id" value="{{ $grupo->id }}">
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Actualizar Evaluación</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <form action="{{ route('evaluacion.destroy', $evaluacion->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm"
                    onclick="return confirm('¿Estás seguro de que deseas eliminar esta evaluación?')">
                    <i class="bi bi-trash3"></i>
                </button>
            </form>

        </div>
    @endforeach

    @include('layouts.barraBaja')
@endsection
