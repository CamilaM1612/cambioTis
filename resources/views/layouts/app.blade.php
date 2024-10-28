<div class="menu__side" id="menu_side">
    <div class="name__page">
        <i class="bi bi-flower1"></i>
        <h4>Score</h4>
    </div>

    <div class="options__menu">

        <a href="{{ route('admin.dashboard') }}"> <!-- Asegúrate de que 'dashboard' sea el nombre correcto de la ruta -->
            <div class="option">
                <i class="bi bi-house"></i> <!-- Icono de inicio -->
                <h4>Inicio</h4>
            </div>
        </a>

        <a href="{{ route('usuarios.index') }}" class="selected">
            <div class="option">
                <i class="bi bi-people"></i>
                <h4>Usuarios</h4>
            </div>
        </a>
        <a href="{{ route('register') }}">
            <div class="option">
                <i class="bi bi-person-plus"></i>
                <h4>Registrar</h4>
            </div>
        </a>



    </div>
</div>
