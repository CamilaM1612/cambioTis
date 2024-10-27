@extends('componentes.menu')

@section('content')
<div class="container">
    <h2>Proyectos Disponibles</h2>
    <ul>
        @foreach($projects as $project)
            <li>
                <a href="{{ route('student.showProject', $project->id) }}">{{ $project->name }}</a>
                <span>{{ $project->description }}</span>
            </li>
        @endforeach
    </ul>
</div>
@endsection
