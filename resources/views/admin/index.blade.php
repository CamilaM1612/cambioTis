@extends('layouts.menu')

@section('content')
    <h1 class="text-center">Lista de Administradores</h1>

    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
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
                @foreach ($administradores as $administrador)
                    <tr>
                        <td>{{ $administrador->id }}</td>
                        <td>{{ $administrador->name }}</td>
                        <td>{{ $administrador->email }}</td>
                        <td>
                            <a href="{{ route('admin.edit', $administrador->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('admin.destroy', $administrador->id) }}" method="POST" style="display:inline;">
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

