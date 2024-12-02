@extends('layouts.menu')

@section('content')
    <h1>Evaluaciones</h1>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createEvaluacionModal">
        Crear Evaluación
    </button>

    <!-- Modal -->
    <div class="modal fade" id="createEvaluacionModal" tabindex="-1" aria-labelledby="createEvaluacionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createEvaluacionModalLabel">Crear Evaluación</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario para crear la evaluación -->
                    <form action="{{ route('evaluaciones.store') }}" method="POST">
                        @csrf

                        <!-- Grupo -->
                        <div class="form-group">
                            <label for="grupo_id">Grupo</label>
                            <select name="grupo_id" id="grupo_id" class="form-control" required>
                                @foreach ($grupos as $grupo)
                                    <option value="{{ $grupo->id }}">{{ $grupo->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tipo de Evaluación -->
                        <div class="form-group">
                            <label for="tipo">Tipo de Evaluación</label>
                            <select name="tipo" id="tipo" class="form-control" required>
                                <option value="autoevaluacion">Autoevaluación</option>
                                <option value="evaluacion_cruzada">Evaluación Cruzada</option>
                                <option value="evaluacion_pares">Evaluación de Pares</option>
                            </select>
                        </div>

                        <!-- Fecha Límite -->
                        <div class="form-group">
                            <label for="fecha_limite">Fecha Límite</label>
                            <input type="date" name="fecha_limite" id="fecha_limite" class="form-control">
                        </div>

                        <!-- Docente ID (se setea automáticamente) -->
                        <input type="hidden" name="docente_id" value="{{ auth()->user()->id }}">

                        <!-- Botones -->
                        <div class="form-group text-right mt-3">
                            <button type="submit" class="btn btn-primary">Crear Evaluación</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <h2>Mis Evaluaciones</h2>
    @foreach ($evaluaciones as $evaluacion)
        <div class="row evaluacion-card">
            <div class="col-md-8 evaluacion-datos">

                <h3>
                    <a href="{{ route('evaluaciones.show', $evaluacion->id) }}">
                        {{ ucfirst($evaluacion->tipo) }}
                    </a>
                </h3>
                <p class="mb-1">Grupo: {{ $evaluacion->grupo->nombre }}</p>
                <p class="mb-1">Fecha límite:
                    {{ $evaluacion->fecha_limite ? $evaluacion->fecha_limite->format('d/m/Y') : 'No especificada' }}</p>
            </div>
            <div class="col-md-4 evaluacion-boton">
                <a href="" class="btn btn-primary">Respuestas</a>
            </div>
        </div>
    @endforeach
@endsection
