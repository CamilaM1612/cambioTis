@extends('layouts.menu')

@section('content')
<div class="container">
    <h2>Autoevaluación para el Sprint: {{ $sprint->nombre }}</h2>

    @if(session('error'))
        <div class="alert alert-warning">
            {{ session('error') }}
        </div>
    @else
        <form action="{{ route('guardar_respuestas', $sprint->id) }}" method="POST">
            @csrf
            @foreach($preguntas as $pregunta)
                <div class="form-group">
                    <label for="pregunta_{{ $pregunta->id }}">{{ $pregunta->texto }}</label>
                    
                    <!-- Tipo F/V: falso/verdadero -->
                    @if($pregunta->tipo == 'f/v')
                        <div>
                            <input type="radio" id="pregunta_{{ $pregunta->id }}_true" name="respuestas[{{ $pregunta->id }}]" value="true" required>
                            <label for="pregunta_{{ $pregunta->id }}_true">Verdadero</label>
                        </div>
                        <div>
                            <input type="radio" id="pregunta_{{ $pregunta->id }}_false" name="respuestas[{{ $pregunta->id }}]" value="false" required>
                            <label for="pregunta_{{ $pregunta->id }}_false">Falso</label>
                        </div>
                    @endif

                    <!-- Tipo escala_1_5: escala de 1 a 5 -->
                    @if($pregunta->tipo == 'escala_1_5')
                        <input type="number" class="form-control" id="pregunta_{{ $pregunta->id }}" name="respuestas[{{ $pregunta->id }}]" min="1" max="5" required>
                    @endif

                    <!-- Tipo respuesta_corta: campo de texto -->
                    @if($pregunta->tipo == 'respuesta_corta')
                        <input type="text" class="form-control" id="pregunta_{{ $pregunta->id }}" name="respuestas[{{ $pregunta->id }}]" required>
                    @endif
                </div>
            @endforeach

            <button type="submit" class="btn btn-primary mt-3">Enviar respuestas</button>
        </form>
    @endif
</div>

@endsection
