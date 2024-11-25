<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CesaePulse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('CSS/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="{{ asset('JS/app.js') }}" defer></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/d5fba335cd.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
</head>
<body>

    <!---------------------------------------- NAVBAR ----------------------------------------------->
    <header class="p-3 mb-3">
        <div class="container">
          <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
            </a>
@auth
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
              <li><a href="{{ route('home.page') }}" class="nav-link px-2 link-secondary">Home</a></li>
              @if (Auth::user()->users_type_id == 1)
              <li><a href="{{ route('admin.home') }}" class="nav-link px-2 link-body-emphasis">Painel Admin</a></li>
              @endif
            </ul>
@endauth
            @if (Route::has('login'))

            <nav class="-mx-3 flex flex-1 justify-end">

                @auth

                    {{ Auth::user()->name }}


                @else
                    <a
                        href="{{ route('login') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                    >
                        Log in
                    </a>

                    @if (Route::has('register'))
                        <a
                            href="{{ route('register') }}"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                        >
                            Register
                        </a>
                    @endif
                @endauth
            </nav>
        @endif
        @auth
            <div class="dropdown text-end ms-2">
              <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <img width="30px" height="30px"
                src="{{ Auth::user()->foto ? asset('storage/' . Auth::user()->foto) : asset('images/defaultUser.png') }}" alt="" style="border-radius: 50%"></td>
              </a>
              <ul class="dropdown-menu text-small" style="">
                <li><a class="dropdown-item" href="#">New project...</a></li>
                <li><a class="dropdown-item" href="{{ route('user.profile', Auth::user()->id) }}">Perfil</a></li>
                <li><hr class="dropdown-divider"></li>
                <form method="POST" action="{{ route('logout') }}" id="logout-form">
                    @csrf
                    <li><a class="dropdown-item" href="#" onclick="document.getElementById('logout-form').submit()">Logout</a></li>
                </form>
              </ul>
            </div>
          </div>
        </div>
      </header>
      @endauth
      <!---------------------------------------- END NAVBAR ----------------------------------------------->

    @yield('content')
    <footer>
    <div class="text-center m-3 text-muted">
        Copyright © 2024 — Cesae
    </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
</body>
</html>
