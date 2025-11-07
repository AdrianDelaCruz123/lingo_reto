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
            <img src="elementos/logo.png" alt="">
            <h1>LINGO</h1>
            <h3>Bienvenido, {{ Auth::user()->name ?? 'Usuario' }}</h3>
        </div>

        <div class="menu">
            <img src="elementos/menu.png" alt="">
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
            <img src="elementos/facebook.png" alt="Facebook">
            <img src="elementos/X.png" alt="Instagram">
            <img src="elementos/instagram.png" alt="Twitter">
        </div>
        <div class="auth">
            <div class="auth-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Cerrar sesión</button>
                </form>
                <img src="elementos/seguridad.png" alt="Seguridad">
            </div>
        </div>
    </footer>
</body>
</html>
