<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Lingo') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">

    
</head>
<body>
    <header>
        <div class="logo">
            <img src="elementos/logo.png" alt="Logo">
            <h1>LINGO</h1>
        </div>

        @if (Route::has('login'))
            <nav class="nav-container">
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn login">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn login">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn register">Register</a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>

    <main>
        <h1>Bienvenido a Lingo</h1>
        <p>Demuestra tus habilidades lingüísticas y diviértete adivinando palabras.</p>
    </main>
</body>
</html>
