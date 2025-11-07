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
                <img src="elementos/logo.png" alt="Logo Lingo">
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
                <img class="imgSocial" src="elementos/facebook.png" alt="Facebook">
            </div>
            <div class="social-icon">
                <img class="imgSocial" src="elementos/X.png" alt="Twitter">
            </div>
            <div class="social-icon">
                <img class="imgSocial" src="elementos/instagram.png" alt="Instagram">
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
                    <img src="elementos/seguridad.png" alt="Seguridad">
                </div>
            </div>
        </div>
    </footer>
    
    <script>
        //-----------------Variables
        let SECRETA = "";
        let posicion = {fila:0, columna:0};
        let palabra = "";
        let racha = 0;
        let intervalo = null;
        let tiempo = 15;
        let seg = 0;

        //-----------------Elementos del html
        const contTiempo = document.getElementById("tiempo");
        const contenedor = document.getElementById("contenedor");
        const teclado = document.getElementById("teclado");
        const contRacha = document.getElementById("racha");
        const btnNuevaPartida = document.getElementById("btnNuevaPartida");

        //----------------Funciones
        async function obtenerPalabraSecreta() {
            try {
                const respuesta = await fetch("/palabrasRandom", {
                    credentials: "same-origin" // importante para rutas con auth
                });

                if (!respuesta.ok) {
                    throw new Error("Error al obtener la palabra: " + respuesta.status);
                }

                const data = await respuesta.json();
                SECRETA = data.word.toUpperCase();
                console.log("Palabra secreta:", SECRETA);
            } catch (error) {
                console.error("Error al obtener la palabra secreta:", error);
                alert("No se pudo obtener la palabra secreta. Usando valor por defecto.");
                SECRETA = "SIFON"; 
            }
        }

        function crearTablero() {
            contenedor.innerHTML = "";
            for (let i = 0; i < 5; i++) {
                for (let j = 0; j < 5; j++) {
                    const celda = document.createElement("div");
                    celda.className = "celda";
                    celda.id = `CelPos${i}${j}`;
                    const letra = document.createElement("div");
                    letra.id = `Pos${i}${j}`;
                    letra.textContent = "";
                    letra.className = "letra-celda";
                    celda.appendChild(letra);
                    contenedor.appendChild(celda);
                }
            }
        }

        function crearTeclado() {
            const abecedario = [
                "A","B","C","D","E","F","G","H","I","J",
                "K","L","M","N","Ñ","O","P","Q","R","S",
                "T","U","V","W","X","Y","Z"
            ];
            teclado.innerHTML = "";
            abecedario.forEach(letra => {
                const tecla = document.createElement("div");
                tecla.className = "tecla";
                tecla.id = letra;
                tecla.textContent = letra;
                tecla.onclick = () => cambiarLetra(letra);
                teclado.appendChild(tecla);
            });
        }

        function iniciarTiempo() {
            clearInterval(intervalo);
            intervalo = setInterval(() => {
                seg++;
                contTiempo.innerText = tiempo - seg;

                if (tiempo - seg <= 0) {
                    clearInterval(intervalo);
                    palabra = "";
                    posicion.columna = 0;
                    validarPalabra(); 
                }
            }, 1000);
        }

        async function cambiarLetra(letra) {
            let letraPos = document.getElementById(`Pos${posicion.fila}${posicion.columna}`);
            letraPos.textContent = letra;
            palabra += letra;
            posicion.columna++;

            if (posicion.columna > 4) {
                await validarPalabra(); // esperamos a que valide antes de limpiar
                palabra = "";           // ahora sí limpiamos después de colorear
                posicion.columna = 0;
            }
        }

        async function validarPalabra() {
            // Primero, verificamos si la palabra existe en la API
            const existe = await verificarPalabraAPI(palabra.toLowerCase());

            clearInterval(intervalo); // detener el timer

            if (!existe) {
                alert("La palabra no existe");
                // pasar a la siguiente fila sin colorear
                posicion.fila++;
                palabra = "";
                posicion.columna = 0;

                if (posicion.fila > 4) {
                    desactivarTeclado();
                    alert("Has perdido");
                    racha = 0;
                    contRacha.innerText = racha;
                    btnNuevaPartida.style.display = "block";
                } else {
                    seg = 0;
                    contTiempo.innerText = tiempo - seg;
                    iniciarTiempo();
                }
                return; // salir de la función
            }

            // Si la palabra existe, coloreamos las letras según aciertos
            let aciertos = 0;
            palabra.split('').forEach((letraLingo, cont) => {
                let celda = document.getElementById(`CelPos${posicion.fila}${cont}`);
                if (!SECRETA.includes(letraLingo)) {
                    celda.style.backgroundColor = "#ff5252";
                } else if (SECRETA[cont] === letraLingo) {
                    celda.style.backgroundColor = "#4caf50";
                    aciertos++;
                } else {
                    celda.style.backgroundColor = "#ff9800";
                }
            });

            if (aciertos === SECRETA.length) {
                desactivarTeclado();
                racha++;
                contRacha.innerText = racha;
                alert(`¡Felicidades! Has ganado\nRacha actual: ${racha}`);
                btnNuevaPartida.style.display = "block";
            } else {
                // pasar a la siguiente fila
                posicion.fila++;
                palabra = "";
                posicion.columna = 0;
                if (posicion.fila > 4) {
                    desactivarTeclado();
                    alert("Has perdido");
                    racha = 0;
                    contRacha.innerText = racha;
                    btnNuevaPartida.style.display = "block";
                } else {
                    seg = 0;
                    contTiempo.innerText = tiempo - seg;
                    iniciarTiempo();
                }
            }
        }

        async function verificarPalabraAPI(palabraUsuario) {
            try {
                const respuesta = await fetch(`http://185.60.43.155:3000/api/check/${palabraUsuario}`);
                if (!respuesta.ok) throw new Error("Error al verificar palabra");
                const data = await respuesta.json();
                return data.exists; // asumimos que el API devuelve { exists: true/false }
            } catch (error) {
                console.error("Error API:", error);
                return false; // si hay error consideramos que la palabra no existe
            }
        }

        function desactivarTeclado() {
            const teclas = teclado.querySelectorAll(".tecla");
            teclas.forEach(tecla => {
                tecla.onclick = null;
                tecla.style.opacity = "0.5";
                tecla.style.cursor = "not-allowed";
            });
        }
        
        async function nuevaPartida() {
            posicion = { fila: 0, columna: 0 };
            palabra = "";
            crearTablero();
            crearTeclado();
            await obtenerPalabraSecreta(); 
            iniciarTiempo();
            btnNuevaPartida.style.display = "none";
        }
        
        async function iniciarJuego() {
            crearTablero();
            crearTeclado();
            iniciarTiempo();
            await obtenerPalabraSecreta();
        }
        
        //--------------------Main
        iniciarJuego();
    </script>
</body>
</html>