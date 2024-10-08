@extends('componentes.menu')

@section('content')
<div class="container">
    <h1>Editar Perfil</h1>
    <form action="{{ route('perfil.update') }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $usuario->name) }}" required>
        </div>
        
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $usuario->email) }}" required>
        </div>
        
        <div class="form-group">
            <label for="phone">Teléfono</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone', $usuario->phone) }}">
        </div>
        
        <div class="form-group">
            <label for="birthdate">Fecha de Nacimiento</label>
            <input type="date" name="birthdate" class="form-control" value="{{ old('birthdate', $usuario->birthdate) }}">
        </div>

        <button type="submit" class="btn btn-success">Actualizar</button>
    </form>
</div>
@endsection
