@extends('layouts.menu')

@section('content')
    <h1 class="text-center">Lista de Docentes</h1>

    <div class="container mt-4">
        <div class="text-end mb-2">
            <a href="{{ route('register') }}" class="btn btn-primary">Registrar</a> <!-- Enlace de registro -->
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($docentes as $docente)
                    <tr>
                        <td>{{ $docente->id }}</td>
                        <td>{{ $docente->name }}</td>
                        <td>{{ $docente->email }}</td>
                        <td>
                            <a href="{{ route('docente.edit', $docente->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('docente.destroy', $docente->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
