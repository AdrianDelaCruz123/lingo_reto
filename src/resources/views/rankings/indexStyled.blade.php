<?php
// Archivo: resources/views/rankings/indexStyled.blade.php
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ranking Global</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #1a2a3a, #2c3e50);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: white;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        header {
            background: linear-gradient(to right, #32A473, #2A8C63);
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logo h1 {
            font-size: 2.5rem;
            font-weight: bold;
        }

        .logo img {
            height: 50px;
        }

        .menu {
            display: flex;
            gap: 20px;
        }

        .menu img {
            height: 35px;
            cursor: pointer;
        }

        main {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 40px 20px;
        }

        .ranking-container {
            background: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 15px;
            width: 100%;
            max-width: 800px;
        }

        h1 {
            color: #32A473;
            text-align: center;
            margin-bottom: 25px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            padding: 12px 15px;
            border-bottom: 2px solid #32A473;
            font-size: 1.2rem;
        }

        td {
            padding: 12px 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background: rgba(255, 255, 255, 0.05);
        }

        footer {
            background: linear-gradient(to right, #32A473, #2A8C63);
            padding: 20px 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: auto;
            color: white;
        }

        button {
            background: linear-gradient(to right, #32A473, #2A8C63);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1.1rem;
            font-weight: bold;
            margin-top: 15px;
        }

        @media (max-width: 768px) {
            .ranking-container {
                padding: 20px;
            }

            th, td {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="/elementos/logo.png" alt="Logo">
            <h1>LINGO</h1>
        </div>

        <div class="menu">
            <a href="{{ route('lingo') }}"><button>🏠 Volver a Lingo</button></a>
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
