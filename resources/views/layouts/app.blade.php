<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Gráficos -->

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/estilos.css">

</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm nav-link-page-cont">
        <div class="container container-nav">
            <a class="navbar-brand color-white nav-prin" href="{{ url('/') }}">
                <span class="icon-nav"><ion-icon name="aperture-outline"></ion-icon></span>{{ config('app.name', 'Asistencia_Control') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                @guest

                @else
                    @if(Auth::user()->cargo == 'Administrador')
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item">
                                <a class="nav-link color-white nav-prin" href="/home"><span class="icon-nav"><ion-icon name="home"></ion-icon></span>{{ __('Home') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link color-white nav-prin" href="/perfil"><span class="icon-nav"><ion-icon name="person"></ion-icon></span>{{ __('Perfil') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link color-white nav-prin" href="/usuarios"><span class="icon-nav"><ion-icon name="people"></ion-icon></span>{{ __('Usuarios') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link color-white nav-prin" href="/cargos"><span class="icon-nav"><ion-icon name="layers"></ion-icon></span>{{ __('Cargos') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link color-white nav-prin" href="/justificaciones"><span class="icon-nav"><ion-icon name="mail"></ion-icon></span>{{ __('Justificaciones') }}</a>
                            </li>
                        </ul>
                    @else
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item">
                                <a class="nav-link color-white nav-prin" href="/home"><span class="icon-nav"><ion-icon name="home"></ion-icon></span>{{ __('Asistencia') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link color-white nav-prin" href="/perfil"><span class="icon-nav"><ion-icon name="person"></ion-icon></span>{{ __('Perfil') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link color-white nav-prin" href="/registro"><span class="icon-nav"><ion-icon name="newspaper"></ion-icon></span>{{ __('Registro') }}</a>
                            </li>
                        </ul>
                    @endif

            @endguest

            <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link color-white nav-prin" href="{{ route('login') }}"><span class="icon-nav"><ion-icon name="log-in-outline"></ion-icon></span>{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item" style="display: none;">
                                <a class="nav-link color-white nav-prin" href="{{ route('register') }}"><span class="icon-nav"><ion-icon name="file-tray-full-outline"></ion-icon></span>{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle color-white" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->nombre }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>

<!-- Iconos -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>

