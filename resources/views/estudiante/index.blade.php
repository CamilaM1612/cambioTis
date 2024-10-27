@extends('layouts.app')

@section('content')
    <h1 class="text-center">Lista de Estudiantes</h1>

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
                @foreach ($estudiantes as $estudiante)
                    <tr>
                        <td>{{ $estudiante->id }}</td>
                        <td>{{ $estudiante->name }}</td>
                        <td>{{ $estudiante->email }}</td>
                        <td>
                            <a href="{{ route('estudiante.edit', $estudiante->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('estudiante.destroy', $estudiante->id) }}" method="POST" style="display:inline;">
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
