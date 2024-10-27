@extends('layouts.appE')

@section('content')
    <div class="container">
        <h1 class="text-center">Lista de Estudiantes Inscritos</h1>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Matrícula</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($estudiantes as $estudiante)
                    <tr>
                        <td>{{ $estudiante->nombre }}</td>
                        <td>{{ $estudiante->correo }}</td>
                        <td>{{ $estudiante->matricula }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">No hay estudiantes inscritos.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
