@extends('componentes.menu')

@section('content')

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card" style="width: 800px;">
        <div class="card-body">
            <h5 class="card-title text-center">Registro</h5>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="row">
                    <!-- Columna izquierda -->
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

                    <div class="col-md-6 mb-3">
                        <label for="birthdate" class="form-label">Fecha de Nacimiento</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                            <input id="birthdate" class="form-control" type="date" name="birthdate" required>
                        </div>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-person-plus"></i> Registrar
                </button>
            </form>
        </div>
    </div>
</div>

@endsection
