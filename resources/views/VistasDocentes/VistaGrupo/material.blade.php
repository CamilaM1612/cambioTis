@extends('layouts.menu')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/docente/dashboard">Página principal</a></li>
        <li class="breadcrumb-item"><a href="/grupos">Grupos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('grupo.avisos', $grupo->id) }}">{{ $grupo->nombre }}</a></li>
        {{-- <li class="breadcrumb-item"><a href="{{ route('grupo.material', $grupo->id) }}"> Material</a></li> --}}
    </ol>
</nav>
@include('layouts.barraBaja')
@endsection