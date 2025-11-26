<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Eventos')</title>

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Estilos opcionais --}}
    <style>
        body {
            background: #f8f9fa;
        }
        .navbar-brand {
            font-weight: bold;
        }
    </style>
</head>
<body>

    {{-- Navbar simples --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('events.index') }}">Eventos</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">

                    {{-- Links extras (opcional) --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('events.index') }}">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('events.create') }}">Criar Evento</a>
                    </li>

                    {{-- Se tiver autenticação no futuro, coloca aqui --}}
                    {{-- 
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="#">{{ auth()->user()->name }}</a>
                        </li>
                    @endauth
                    --}}
                </ul>
            </div>
        </div>
    </nav>

    {{-- Conteúdo principal --}}
    <main>
        @yield('content')
    </main>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
