<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lingo</title>
    <link rel="stylesheet" href="{{ asset('css/lingo.css') }}">
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

    <div class="main">
        <div class="game">
            <div class="info">
                <h3>¿Qué es Lingo?</h3>
                <p>Lingo es un juego de adivinar palabras, con un formato de crucigrama. Tienes cinco intentos para adivinar la palabra secreta y saber qué letras están correctas. ¡Demuestra tu vocabulario y habilidades lingüísticas!</p>
            </div>

            <div class="board">
                <div id="contenedor"></div>
                <div id="teclado"></div>
            </div>
        </div>

        <div class="stats">
            <div class="ranking">
                <h3>Ranking Global</h3>
                <table class="ranking-table">
                    <tr>
                        <th>Top</th>
                        <th>Racha</th>
                    </tr>
                    <tr>
                        <td>1#</td>
                        <td>23</td>
                    </tr>
                    <tr>
                        <td>2# </td>
                        <td>19</td>
                    </tr>
                    <tr>
                        <td>3#</td>
                        <td>15</td>
                    </tr>
                    <tr>
                        <td>4#</td>
                        <td>10</td>
                    </tr>
                    <tr>
                        <td>5#</td>
                        <td>8</td>
                    </tr>
                </table>
                <form action="{{ route('rankings.indexStyled') }}" method="GET" style="display:inline;">
                    <button type="submit">Ver Ranking</button>
                </form>
            </div>

            <div class="timer">
                <h2>Tiempo restante:</h2>
                <div id="tiempo">15</div>
                <div class="streak">Racha actual: <span id="racha">0</span> <span class="diamond"></span></div>
                <button id="btnNuevaPartida" style="display:none;" onclick="nuevaPartida()">Nueva partida</button>
            </div>
        </div>
    </div>

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
                    letra.style.fontSize = "2rem";
                    letra.style.fontWeight = "bold";
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


        function cambiarLetra(letra) {
            let letraPos = document.getElementById(`Pos${posicion.fila}${posicion.columna}`);
            letraPos.textContent = letra;
            palabra += letra;
            posicion.columna++;

            if (posicion.columna > 4) {
                validarPalabra();
                palabra = "";
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
