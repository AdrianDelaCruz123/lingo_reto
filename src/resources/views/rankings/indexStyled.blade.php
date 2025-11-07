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
            <img src="/elementos/logo.png" alt="Logo">
            <h1>LINGO</h1>
        </div>

        <div class="menu">
            <a href="{{ route('lingo') }}"><button>Volver a Lingo</button></a>
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
        Lingo &copy; {{ date('Y') }}
    </footer>
</body>
</html>
