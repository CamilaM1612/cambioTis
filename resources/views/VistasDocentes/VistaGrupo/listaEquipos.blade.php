@extends('layouts.menu')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/docente/dashboard">Página principal</a></li>
        <li class="breadcrumb-item"><a href="/grupos">Grupos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('grupo.avisos', $grupo->id) }}">{{ $grupo->nombre }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('grupo.equipos', $grupo->id) }}"> Equipos</a></li>
    </ol>
</nav>
<h3>Equipos en {{ $grupo->nombre }}</h3>
    <ul class="list-group">
        @foreach($grupo->equipos as $equipo)
            <li class="list-group-item">
        
                <a href="{{ route('grupo.equipo.informacion', $equipo->id) }}">
                    {{ $equipo->nombre_empresa }}
                </a>
            </li>
        @endforeach
    </ul>
@include('layouts.barraBaja')
@endsection
