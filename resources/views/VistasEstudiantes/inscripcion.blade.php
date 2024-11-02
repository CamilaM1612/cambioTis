@extends('layouts.menu')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/estudiante/dashboard">Página principal</a></li>
        <li class="breadcrumb-item"><a href="/estudiante/inscripcion">Inscripcion</a></li>
    </ol>
</nav>
    <div class="container">

        <h2>Grupos Disponibles</h2>

        @foreach ($grupos as $grupo)
            <div class="accordion m-3" id="grupoInscripcion">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#grupoInscripcion{{ $grupo->id }}" aria-expanded="true"
                            aria-controls="grupoInscripcion{{ $grupo->id }}">
                            {{ $grupo->nombre }}
                            

                        </button>
                    </h2>
                    <div id="grupoInscripcion{{ $grupo->id }}" class="accordion-collapse collapse"
                        data-bs-parent="#grupoInscripcion">
                        <div class="accordion-body">
                            {{ $grupo->descripcion }}
                            @if ($usuario->gruposAsignados()->where('grupo_id', $grupo->id)->exists())
                                <p class="alert alert-info text-center p-2 m-3">Ya estás inscrito en este grupo.</p>
                            @else
                                <form action="{{ route('estudiante.registrar') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="codigo">Código del grupo:</label>
                                        <input type="text" name="codigo" class="form-control" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Inscribirse</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        @endforeach

    </div>
@endsection
