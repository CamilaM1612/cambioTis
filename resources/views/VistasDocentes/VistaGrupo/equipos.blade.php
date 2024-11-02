@extends('layouts.menu')

@section('content')
<div class="container">
    <h1>Equipos de {{ $grupo->nombre }}</h1>
    
    @if($grupo->equipos->isEmpty())
        <p>No hay equipos en este grupo.</p>
    @else
        @foreach($grupo->equipos as $equipo)
            <div class="card mb-3">
                <div class="card-header">
                    <h5>{{ $equipo->nombre_empresa }}</h5>
                </div>
                <div class="card-body">
                    <h6>Miembros:</h6>
                    <ul>
                        @foreach($equipo->miembros as $miembro)
                            <li>{{ $miembro->name }} ({{ $miembro->email }})</li>
                        @endforeach
                    </ul>

                    <h6>Sprints:</h6>
                    <ul>
                        @foreach($equipo->sprints as $sprint)
                            <li>{{ $sprint->nombre }} - {{ $sprint->fecha_inicio }} a {{ $sprint->fecha_fin }}</li>
                            <p>{{$sprint->objetivo}}</p>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach
    @endif
</div>
@include('layouts.barraBaja')
@endsection