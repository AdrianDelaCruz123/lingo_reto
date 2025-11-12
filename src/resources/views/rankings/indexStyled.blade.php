<?php
// Archivo: resources/views/rankings/indexStyled.blade.php
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ranking Global</title>
    <link rel="stylesheet" href="{{ asset('css/rankin.css') }}">

</head>
<body>
    <header>
        <div class="logo">
            <a href="http://lingo.local:8080"><img src="elementos/logo.png" alt=""></a>
            <h1>LINGO</h1>
            <h3>Bienvenido, {{ Auth::user()->name ?? 'Usuario' }}</h3>
        </div>

        <div class="menu">
            <a href="http://lingo.local:8080/lingo"><img src="elementos/menu.png" alt=""></a>
        </div>
    </header>

    <main>
        <div class="ranking-container">
            <h1>Ranking Global</h1>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Racha</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($rankings as $ranking)
                        <tr>
                            <td>{{ $ranking->id }}</td>
                            <td>{{ $ranking->nombre }}</td>
                            <td>{{ $ranking->intentos }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" style="text-align:center;">No hay registros.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>

    <footer>
        <div class="social">
            <div class="social-icon">
                <img class="imgSocial" src="{{ asset('elementos/facebook.png') }}" alt="Logo">
            </div>
            <div class="social-icon">
                <img class="imgSocial" src="{{ asset('elementos/X.png') }}" alt="Logo">
            </div>
            <div class="social-icon">
                <img class="imgSocial" src="{{ asset('elementos/instagram.png') }}" alt="Logo">
            </div>
        </div>
        <div class="auth">
            <div class="auth-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button id="CerrarSesion" type="submit" class="logout-btn">
                        <span>Cerrar sesión</span>
                    </button>
                </form>
                <div class="security-icon">
                <img src="{{ asset('elementos/seguridad.png') }}" alt="Logo">
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
