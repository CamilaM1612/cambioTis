@extends('componentes.menu')

@section('content')
    <div class="container">
        <h1>Crear Nuevo Grupo</h1>

        <form action="{{ route('grupos.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del Grupo</label>
                <input type="text" name="nombre" id="nombre" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-success">Crear Grupo</button>
        </form>
    </div>
@endsection
