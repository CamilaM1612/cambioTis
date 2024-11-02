@extends('layouts.menu')

@section('content')
<div class="container">
    <h1>Novedades de {{ $grupo->nombre }}</h1>
    <ul class="list-group">
        @forelse ($grupo->avisos as $aviso)
            <li class="list-group-item">{{ $aviso->titulo }} - {{ $aviso->contenido }}</li>
        @empty
            <li class="list-group-item">No hay novedades.</li>
        @endforelse
    </ul>
</div>
@include('layouts.barraBaja')
@endsection