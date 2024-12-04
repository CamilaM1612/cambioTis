

@extends('layouts.menu')

@section('content')
<form action="{{ route('evaluacion.guardarRespuestas', $evaluacion->id) }}" method="POST">
    @csrf
    @foreach ($evaluacion->preguntas as $pregunta)
        <div class="form-group">
            <label>{{ $pregunta->pregunta }}</label>

            @if ($pregunta->tipo_respuesta == 'escala_1_5')
                <input type="number" name="respuesta[{{ $pregunta->id }}]" min="1" max="5" class="form-control">
            @elseif ($pregunta->tipo_respuesta == 'verdadero_falso')
                <select name="respuesta[{{ $pregunta->id }}]" class="form-control">
                    <option value="verdadero">Verdadero</option>
                    <option value="falso">Falso</option>
                </select>
            @elseif ($pregunta->tipo_respuesta == 'respuesta_corta')
                <input type="text" name="respuesta[{{ $pregunta->id }}]" class="form-control">
            @endif
        </div>
    @endforeach

    <button type="submit" class="btn btn-success">Enviar Respuestas</button>
</form>
@endsection