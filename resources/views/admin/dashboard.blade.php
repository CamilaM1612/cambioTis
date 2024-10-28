@extends('layouts.menu')

@section('content')
    <h1 class="text-center">Bienvenido al Dashboard de Administración</h1>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img src="{{ asset('images/docente.png') }}" class="card-img-top" alt="Lista de Docentes">
                    <div class="card-body text-center">
                        <h5 class="card-title">Lista de Docentes</h5>
                        <a href="{{ route('docente.index') }}" class="btn btn-primary">Ver Lista</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img src="{{ asset('images/estudiante.png') }}" class="card-img-top" alt="Lista de Estudiantes">
                    <div class="card-body text-center">
                        <h5 class="card-title">Lista de Estudiantes</h5>
                        <a href="{{ route('estudiante.index') }}" class="btn btn-primary">Ver Lista</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img src="{{ asset('images/admin.png') }}" class="card-img-top" alt="Lista de Administradores">
                    <div class="card-body text-center">
                        <h5 class="card-title">Lista de Administradores</h5>
                        <a href="{{ route('admin.index') }}" class="btn btn-primary">Ver Lista</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
