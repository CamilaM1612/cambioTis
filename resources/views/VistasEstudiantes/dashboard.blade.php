@extends('layouts.menu')

@section('content')
<div class="container">
    <h2>Bienvenido, {{ Auth::user()->name }}</h2>
    <h1 class="h2">Área personal</h1>
   
    <div class="row mt-4">
        @if ($grupos->isEmpty())
            <p>No estás inscrito en ninguna materia.</p>
        @else
            @foreach ($grupos as $grupo)
                <div class="col-md-4 mb-3">
                    <div class="card text-white bg-primary" style="width: 100%;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $grupo->nombre }}</h5>                          
                            <a href="{{ route('grupo.mostrar', $grupo->id) }}" class="btn btn-light">Ver Detalles</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>


@endsection
