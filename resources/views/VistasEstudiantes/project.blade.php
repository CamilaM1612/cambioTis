@extends('layouts.menu')

@section('content')
<div class="container">
    <h2>{{ $project->name }}</h2>
    <p>{{ $project->description }}</p>

    <h3>Subir Entregable</h3>
    <form action="{{ route('student.submitProject', $project->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="submission" required>
        <button type="submit">Subir</button>
    </form>
</div>
@endsection
