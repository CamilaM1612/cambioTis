<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        :root {
            --primary-color: #5CCFCF;
            --secondary-color: #FFD68A;
            --accent-color: #FF6B6B;
            --background-color: #FFFFFF;
            --text-color: #2C3E50;
            --light-text: #34495E;
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            --header-height: 60px;
            --menu-width: 250px;
            --transition-speed: 300ms;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'SF Pro Display', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
            line-height: 1.6;
            overflow-x: hidden;
            width: 100%;
            min-height: 100vh;
            transition: margin-left var(--transition-speed) cubic-bezier(0.785, 0.135, 0.15, 0.86);
        }

        header {
            background-color: var(--primary-color);
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            width: 100%;
            height: var(--header-height);
            top: 0;
            left: 0;
            z-index: 1000;
            box-shadow: var(--shadow);
        }

        .icon__menu {
            cursor: pointer;
            width: 40px;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.5rem;
            color: white;
            border-radius: 50%;
            transition: background-color var(--transition-speed);
        }

        .icon__menu:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .dropdown .btn {
            color: white;
        }

        .menu__side {
            background: var(--primary-color);
            width: var(--menu-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: calc(-1 * var(--menu-width));
            transition: left var(--transition-speed) ease;
            z-index: 999;
            padding-top: var(--header-height);
            box-shadow: var(--shadow);
        }

        .menu__side.menu__side_move {
            left: 0;
        }

        .name__page {
            padding: 20px;
            color: white;
            display: flex;
            align-items: center;
            gap: 10px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .name__page h4 {
            margin: 0;
            font-size: 1.2rem;
            font-weight: 600;
        }

        .options__menu {
            padding: 10px 0;
        }

        .options__menu a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            padding: 12px 20px;
            display: block;
            transition: all var(--transition-speed);
            position: relative;
        }

        .options__menu a:hover,
        .options__menu a.selected {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .option {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .option h4 {
            margin: 0;
            font-size: 1rem;
            font-weight: 500;
        }

        main {
            padding: calc(var(--header-height) + 20px) 20px 20px;
            transition: margin-left var(--transition-speed) ease;
        }

        @media (min-width: 768px) {
            body.body_move main {
                margin-left: var(--menu-width);
            }
        }

        @media (max-width: 767px) {
            .menu__side {
                width: 100%;
                left: -100%;
            }
            
            .menu__side.menu__side_move {
                left: 0;
            }
        }
    </style>
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
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="/perfil">Perfil</a></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
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
                    <i class="bi bi-house-door"></i>
                    <h4>Inicio</h4>
                </div>
            </a>
            <a href="/lista">
                <div class="option">
                    <i class="bi bi-file-earmark"></i>
                    <h4>Registrados</h4>
                </div>
            </a>
            <a href="#">
                <div class="option">
                    <i class="bi bi-play-btn"></i>
                    <h4>Grupos</h4>
                </div>
            </a>
            <a href="#">
                <div class="option">
                    <i class="bi bi-journal-text"></i>
                    <h4>Blog</h4>
                </div>
            </a>
            <a href="#">
                <div class="option">
                    <i class="bi bi-person-badge"></i>
                    <h4>Contacto</h4>
                </div>
            </a>
            <a href="#">
                <div class="option">
                    <i class="bi bi-person-lines-fill"></i>
                    <h4>Nosotros</h4>
                </div>
            </a>
        </div>
    </div>

    <main>
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sideMenu = document.getElementById("menu_side");
            const btnOpen = document.getElementById("btn_open");
            const body = document.getElementById("body");

            function toggleMenu() {
                body.classList.toggle("body_move");
                sideMenu.classList.toggle("menu__side_move");
            }

            if (btnOpen) {
                btnOpen.addEventListener("click", toggleMenu);
            }

            function handleResponsive() {
                if (window.innerWidth >= 768) {
                    setTimeout(() => {
                        body.classList.add("body_move");
                        sideMenu.classList.add("menu__side_move");
                    }, 100);
                }
            }

            handleResponsive();

            let resizeTimer;
            window.addEventListener("resize", function() {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(() => {
                    if (window.innerWidth < 768) {
                        body.classList.remove("body_move");
                        sideMenu.classList.remove("menu__side_move");
                    } else {
                        handleResponsive();
                    }
                }, 250);
            });
        });
    </script>
</body>
</html>