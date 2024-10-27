@extends('componentes.menu')

@section('content')
<div class="container">
    <h2>Bienvenido, {{ Auth::user()->name }}</h2>
    <h3>Tus Proyectos</h3>
    <ul>
        @foreach($projects as $project)
            <li>
                <a href="{{ route('student.showProject', $project->id) }}">{{ $project->name }}</a>
                (Progreso: {{ $project->progress }}%)
            </li>
        @endforeach
    </ul>
</div>
@endsection
