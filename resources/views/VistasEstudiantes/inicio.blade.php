@extends('componentes.menu')<!-- Adjust according to your layout file -->

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard Estudiante</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Bienvenido al panel de estudiante!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection