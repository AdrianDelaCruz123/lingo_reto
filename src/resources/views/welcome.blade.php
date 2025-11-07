<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Lingo') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
</head>
<body>
    <div class="background-pattern"></div>
    
    <header>
        <div class="logo">
            <div class="logo-icon">
                <img src="elementos/logo.png" alt="Logo">
            </div>
            <h1>LINGO</h1>
        </div>

        @if (Route::has('login'))
            <nav class="nav-container">
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn login">
                        <span>Dashboard</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn login">
                        <span>Log in</span>
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn register">
                            <span>Register</span>
                        </a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>

    <main>
        <div class="hero-content">
            <h1>Bienvenido a <span class="highlight">Lingo</span></h1>
            <p class="subtitle">Demuestra tus habilidades lingüísticas y diviértete adivinando palabras.</p>
            
            <div class="cta-container">
                @auth
                    <a href="{{ url('/dashboard') }}" class="cta-btn primary">Jugar Ahora</a>
                @else
                    <a href="{{ route('register') }}" class="cta-btn primary">Comenzar Gratis</a>
                    <a href="{{ route('login') }}" class="cta-btn secondary">Ya tengo cuenta</a>
                @endauth
            </div>
        </div>
        
        <div class="info-card">
            <div class="card-icon">?</div>
            <h3>¿Qué es Lingo?</h3>
            <p>Lingo es un juego de adivinar palabras, con un formato de crucigrama. Tienes cinco intentos para adivinar la palabra secreta y saber qué letras están correctas. ¡Demuestra tu vocabulario y habilidades lingüísticas!</p>
        </div>
        
        <div class="features">
            <div class="feature">
                <h4>Desafía tu mente</h4>
                <p>Pon a prueba tu vocabulario y habilidades lingüísticas</p>
            </div>
            <div class="feature">
                <h4>Compite con amigos</h4>
                <p>Comparte tus logros y compite por los primeros puestos</p>
            </div>
            <div class="feature">
                <h4>Juega en cualquier lugar</h4>
                <p>Diseño responsive para jugar en cualquier dispositivo</p>
            </div>
        </div>
    </main>
</body>
</html>