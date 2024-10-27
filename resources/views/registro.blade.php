@extends('layouts.app')

@section('content')

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card shadow-lg w-100" style="max-width: 600px;">
        <div class="card-body">
            <h5 class="card-title text-center mb-4" style="font-size: 1.75rem;">Registro</h5>
            <!-- Cambiamos el action para que apunte a la nueva ruta -->
            <form method="POST" action="{{ route('usuarios.store') }}">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input id="name" class="form-control" type="text" name="name" required autofocus autocomplete="name">
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input id="email" class="form-control" type="email" name="email" required>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                            <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="role_id" class="form-label">Seleccionar Rol</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                            <select id="role_id" name="role_id" class="form-select" required>
                                @foreach ($roles as $rol)
                                    <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label">Número de Teléfono</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                            <input id="phone" class="form-control" type="tel" name="phone" pattern="[0-9]{8,15}" placeholder="Ingrese un número válido" required>
                        </div>
                        <small class="form-text text-muted">Debe contener entre 8 y 15 dígitos</small>
                    </div>

                    
                </div>
                
                <!-- El botón que redirige a la página 'usuarios' -->
                <button type="submit" class="btn btn-primary w-100 mt-4">
                    <i class="bi bi-person-plus"></i> Registrar

                </button>
            </form>
        </div>
    </div>
</div>

@endsection
