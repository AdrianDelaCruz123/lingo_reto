<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Rankings</title>
</head>
<body>
    <h1>Mi Diccionario</h1>


    <ul>
        @forelse ($rankings as $ranking)
            <li>{{ $ranking->ranking }}</li>
        @empty
            <li>No hay usuarios en la base de datos.</li>
        @endforelse
    </ul>


</body>
</html>
