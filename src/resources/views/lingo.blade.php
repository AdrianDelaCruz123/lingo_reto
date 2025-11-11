<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lingo</title>
    <link rel="stylesheet" href="{{ asset('css/lingo.css') }}">
</head>
<body>
    <div class="background-pattern"></div>
    
    <header>
        <div class="logo">
            <div class="logo-icon">
                <a href="http://lingo.local:8080"><img src="{{ asset('elementos/logo.png') }}" alt="Logo"></a>
            </div>
            <div class="logo-text">
                <h1>LINGO</h1>
                <h3 class="welcome-text">Bienvenido, {{ Auth::user()->name ?? 'Usuario' }}</h3>
            </div>
        </div>

        <div class="menu">
            <div class="menu-icon">
                <img src="elementos/menu.png" alt="Menú">
            </div>
        </div>
    </header>

    <div class="main">
        <div class="game">
            <div class="board">
                <div id="contenedor"></div>
                <div id="teclado"></div>
            </div>
        </div>

        <div class="stats">
            <div class="ranking-card">
                <div class="card-header">
                    <h3>Ranking Global</h3>
                </div>
                <table class="ranking-table">
                    <thead>
                        <tr>
                            <th>Top</th>
                            <th>Racha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class="top-badge top-1">1#</span></td>
                            <td>23</td>
                        </tr>
                        <tr>
                            <td><span class="top-badge top-2">2#</span></td>
                            <td>19</td>
                        </tr>
                        <tr>
                            <td><span class="top-badge top-3">3#</span></td>
                            <td>15</td>
                        </tr>
                        <tr>
                            <td><span class="top-badge">4#</span></td>
                            <td>10</td>
                        </tr>
                        <tr>
                            <td><span class="top-badge">5#</span></td>
                            <td>8</td>
                        </tr>
                    </tbody>
                </table>
                <form action="{{ route('rankings.indexStyled') }}" method="GET" class="ranking-btn-container">
                    <button type="submit" class="ranking-btn">Ver Ranking Completo</button>
                </form>
            </div>

            <div class="timer-card">
                <div class="card-header">
                    <h2>Tiempo restante</h2>
                </div>
                <div id="tiempo" class="time-display">15</div>
                <div class="streak-container">
                    <div class="streak-text">Racha actual: <span id="racha">0</span></div>
                </div>
                <button id="btnNuevaPartida" style="display:none;" onclick="nuevaPartida()" class="new-game-btn">Nueva partida</button>
            </div>
        </div>
    </div>

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
    
    <script  src="{{ asset('js/lingo.js') }}"></script>

</body>
</html>