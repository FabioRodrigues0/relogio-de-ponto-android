<!DOCTYPE html>
<html lang="en">

<head>
    <!DOCTYPE html>
    <html lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CesaePulse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Boxicons -->
    <link href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/d5fba335cd.js" crossorigin="anonymous"></script>
    <!-- Custom CSS (optional, remove if not needed) -->
    <link rel="stylesheet" href="{{ asset('CSS/styleMaster.css') }}">
    <script src="{{ asset('JS/app.js') }}" defer></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">


</head>


<!---------------------------------------- NAVBAR ----------------------------------------------->

<body id="body-pd">
    <header class="header" id="header">

        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>

    </header>

    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div> <a href="#" class="nav_logo"> <i class="fa-solid fa-user-clock nav_logo-icon"></i> <span
                        class="nav_logo-name">CesaePulse</span> </a>
                <div class="nav_list"> <a href="{{ route('admin.home') }}" class="nav_link {{ request()->routeIs('admin.home') ? 'active' : '' }}"> <i
                            class='bx bx-grid-alt nav_icon'></i>
                        <span class="nav_name">Home</span> </a> <a href="{{ route('home.page') }}" class="nav_link {{ request()->routeIs('home.page') ? 'active' : '' }}"> <i
                            class='bx bx-user nav_icon'></i>
                        <span class="nav_name">Meu Perfil</span> </a>  <a href="{{ route('users.home') }}" class="nav_link {{ request()->routeIs('users.home') ? 'active' : '' }}">
                        <i class='bx bx-bookmark nav_icon'></i> <span class="nav_name">Cesae Utilizadores</span> </a>
                        <a href="{{ route('register.get') }}" class="nav_link {{ request()->routeIs('register.get') ? 'active' : '' }}"> <i
                            class='bx bx-message-square-detail nav_icon'></i>
                        <span class="nav_name">Registar Utilizador</span> </a>
                    <a href="{{ route('admin.allStatistics') }}" class="nav_link {{ request()->routeIs('admin.allStatistics') ? 'active' : '' }}"> <i
                            class='bx bx-bar-chart-alt-2 nav_icon'></i>
                        <span class="nav_name">Estatística</span> </a>

                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                @csrf
                <li> <a href="#" class="nav_link"> <i class='bx bx-log-out nav_icon'
                            onclick="document.getElementById('logout-form').submit()"></i> <span class="nav_name"
                            onclick="document.getElementById('logout-form').submit()">Logout</span> </a>

            </form>

        </nav>

    </div>

    <!--Container Main start-->
    <main>
        @yield('content')
    </main>
    <!--Container Main end-->

    <footer>
        <div class="text-center m-3 text-muted">
            Copyright © 2024 — Cesae
        </div>

    </footer>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
</body>
