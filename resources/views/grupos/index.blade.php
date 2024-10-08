@extends('componentes.menu')
@section('content')
    <div class="container">
        <h1>Grupos de Estudiantes</h1>
        <a href="{{ route('grupos.create') }}" class="btn btn-primary mb-3">Crear Nuevo Grupo</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($grupos as $grupo)
                    <tr>
                        <td>{{ $grupo->nombre }}</td>
                        <td>{{ $grupo->descripcion }}</td>
                        <td>
                            <!-- Aquí puedes agregar botones de editar y eliminar si es necesario -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
