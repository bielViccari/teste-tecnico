<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>TecnicalCase</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Tecnical Case</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Cadastros
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Cadastrar Clientes</a></li>
                                <li><a class="dropdown-item" href="#">Cadastrar Produtos</a></li>
                            </ul>
                        </li>
                    @endauth
                </ul>
                <span class="navbar-text">
                    @if (Route::has('login'))
                        @auth
                            <a class="btn btn-primary text-light" href="{{ url('/dashboard') }}"
                                role="button">Dashboard</a>
                        @else
                            <a class="btn btn-outline-primary" href="{{ route('login') }}" role="button">Entrar</a>
                            @if (Route::has('register'))
                                <a class="btn btn-primary text-light" href="{{ route('register') }}"
                                    role="button">Registrar-se</a>
                            @endif
                        @endauth
                    @endif
                </span>
            </div>
        </div>
    </nav>
</body>

</html>
