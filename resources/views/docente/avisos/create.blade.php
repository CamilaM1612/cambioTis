@extends('layouts.appD')

@section('content')
<div class="container">
    <h1>Publicar un Aviso</h1>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <form action="{{ route('avisos.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="titulo">Título del Aviso</label>
            <input type="text" name="titulo" class="form-control" id="titulo" required>
        </div>

        <div class="form-group">
            <label for="contenido">Contenido del Aviso</label>
            <textarea name="contenido" class="form-control" id="contenido" rows="5" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Publicar Aviso</button>
    </form>
</div>
@endsection
