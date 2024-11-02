@extends('layouts.menu')

@section('content')
<div class="container">
    
    @forelse ($grupos as $grupo)
        <h2>Grupo: {{ $grupo->nombre }}</h2>
        <p><strong>Descripción:</strong> {{ $grupo->descripcion }}</p>
        <p><strong>Código:</strong> {{ $grupo->codigo }}</p>

        <h3>Equipos</h3>
        @forelse ($grupo->equipos as $equipo)
            <div class="card mb-3">
                <div class="card-header">
                    <h4>Equipo: {{ $equipo->nombre_empresa }}</h4>
                    <p><strong>Correo de la Empresa:</strong> {{ $equipo->correo_empresa }}</p>
                    <p><strong>Link de Drive:</strong> <a href="{{ $equipo->link_drive }}" target="_blank">Acceder</a></p>
                </div>
                <div class="card-body">
                    <h5>Sprints del Equipo</h5>
                    @if ($equipo->sprints->isEmpty())
                        <p>No hay sprints en este equipo.</p>
                    @else
                        <ul>
                            @foreach ($equipo->sprints as $sprint)
                                <li>
                                    <strong>{{ $sprint->nombre }}</strong> - 
                                    {{ $sprint->fecha_inicio }} a {{ $sprint->fecha_fin }}                                    
                                </li>
                                <li>
                                    <strong>Objetivo del Sprint: </strong> {{ $sprint->objetivo}}
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    <h5>Miembros del Equipo</h5>
                    @if ($equipo->miembros->isEmpty())
                        <p>No hay miembros en este equipo.</p>
                    @else
                        <ul>
                            @foreach ($equipo->miembros as $miembro)
                                <li>{{ $miembro->name }} - {{ $miembro->email}}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        @empty
            <p>No hay equipos en este grupo.</p>
        @endforelse
    @empty
        <p>No hay grupos disponibles.</p>
    @endforelse
</div>
@endsection
