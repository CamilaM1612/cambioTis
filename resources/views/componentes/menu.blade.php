<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href={{ asset('css/menu.css') }}>
    <title>Document</title>
</head>

<body id="body">

    <header>
        <div class="icon__menu">
            <i class="bi bi-list" id="btn_open"></i>
        </div>

        <div class="dropdown">
            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-start">
                <li><a class="dropdown-item active" href="#">Perfil</a></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="dropdown-item">Cerrar sesión</button>
                    </form>
                </li>
            </ul>
        </div>
    </header>

    <div class="menu__side" id="menu_side">

        <div class="name__page">
            <i class="bi bi-flower1"></i>
            <h4>Score</h4>
        </div>

        <div class="options__menu">

            <a href="/admin/dashboard" class="selected">
                <div class="option">
                    <i class="bi bi-house-door" title="Inicio"></i>
                    <h4>Inicio</h4>
                </div>
            </a>

            <a href="/listaRegistrados">
                <div class="option">
                    <i class="bi bi-file-earmark" title="lista"></i>
                    <h4>Registrados</h4>
                </div>
            </a>

            <a href="#">
                <div class="option">
                    <i class="bi bi-play-btn" title="Cursos"></i>
                    <h4>Grupos</h4>
                </div>
            </a>

            <a href="#">
                <div class="option">
                    <i class="bi bi-journal-text" title="Blog"></i>
                    <h4>Blog</h4>
                </div>
            </a>

            <a href="#">
                <div class="option">
                    <i class="bi bi-person-badge" title="Contacto"></i>
                    <h4>Contacto</h4>
                </div>
            </a>

            <a href="#">
                <div class="option">
                    <i class="bi bi-person-lines-fill" title="Nosotros"></i>
                    <h4>Nosotros</h4>
                </div>
            </a>

        </div>

    </div>

    <main>
        @yield('content')
    </main>

    <script src={{ asset('js/menu.js') }}></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
