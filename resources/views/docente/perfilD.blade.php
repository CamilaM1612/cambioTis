@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card profile-card" style="border-radius: 16px; box-shadow: var(--shadow);">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <div class="profile-avatar">
                            <i class="bi bi-person-circle" style="font-size: 60px; color: var(--primary-color);"></i>
                        </div>
                        <h2 class="mt-3">{{ $usuario->name }}</h2>
                    </div>
                    
                    <div class="profile-info">
                        <div class="info-item">
                            <i class="bi bi-envelope"></i>
                            <div>
                                <h6>Correo Electrónico</h6>
                                <p>{{ $usuario->email }}</p>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <i class="bi bi-telephone"></i>
                            <div>
                                <h6>Teléfono</h6>
                                <p>{{ $usuario->phone }}</p>
                            </div>
                        </div>
                        
                        
                    </div>

                    <div class="text-center mt-4">
                        <a href="{{ route('perfil.edit') }}" class="btn btn-primary">
                            <i class="bi bi-pencil"></i> Editar Perfil
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
