<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CesaePulse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('CSS/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="{{ asset('JS/app.js') }}" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Boxicons -->
    <link href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/d5fba335cd.js" crossorigin="anonymous"></script>
    <!-- Custom CSS (optional, remove if not needed) -->
    <link rel="stylesheet" href="{{ asset('CSS/styleMaster.css') }}">
</head>


    <!---------------------------------------- NAVBAR ----------------------------------------------->

    <body id="body-pd">
        <header class="header" id="header">

            <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>

        </header>

        <div class="l-navbar" id="nav-bar">
            <nav class="nav">
                <div> <a href="#" class="nav_logo"> <i class="fa-solid fa-user-clock nav_logo-icon"></i> <span
                            class="nav_logo-name">CesaeClock</span> </a>
                    <div class="nav_list"> <a href="{{ route('admin.home') }}" class="nav_link active"> <i
                                class='bx bx-grid-alt nav_icon'></i>
                            <span class="nav_name">Home</span> </a> <a href="{{ route('home.page') }}" class="nav_link"> <i
                                class='bx bx-user nav_icon'></i>
                            <span class="nav_name">Meu Perfil</span> </a> <a href="#" class="nav_link"> <i
                                class='bx bx-message-square-detail nav_icon'></i>
                            <span class="nav_name">Notificações</span> </a> <a href="#"
                            class="nav_link">
                            <i class='bx bx-bookmark nav_icon'></i> <span class="nav_name">Cesae Comunidade</span> </a>
                        <a href="#" class="nav_link"> <i class='bx bx-folder nav_icon'></i>
                            <span class="nav_name">Histórico</span> </a> <a href="#" class="nav_link"> <i
                                class='bx bx-bar-chart-alt-2 nav_icon'></i>
                            <span class="nav_name">Estatistica</span> </a>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}" id="logout-form">
                    @csrf
                    <li> <a href="#" class="nav_link"> <i class='bx bx-log-out nav_icon' onclick="document.getElementById('logout-form').submit()"></i> <span
                           class="nav_name" onclick="document.getElementById('logout-form').submit()">Logout</span> </a>

                </form>

            </nav>

        </div>

        <!--Container Main start-->

        <!--Container Main end-->
        @yield('content')
        </main>
        <footer>
            <div class="text-center m-3 text-muted">
                Copyright © 2024 — Cesae
            </div>
        </footer>



