<!-- resources/views/tareas/index.blade.php -->
@extends('layouts.menu')

@section('content')
    <h1>Subir Tareas</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('tareas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="parte_a" class="form-label">Seleccionar Tarea Parte A</label>
            <input type="file" class="form-control" id="parte_a" name="parte_a" required>
        </div>
        <div class="mb-3">
            <label for="parte_b" class="form-label">Seleccionar Tarea Parte B</label>
            <input type="file" class="form-control" id="parte_b" name="parte_b" required>
        </div>
        <button type="submit" class="btn btn-primary">Subir Tareas</button>
    </form>
@endsection
