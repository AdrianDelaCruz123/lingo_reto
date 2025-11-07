<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lingo</title>
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

        .main {
            display: flex;
            flex: 1;
            padding: 30px;
            gap: 30px;
        }

        .game {
            flex: 3;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 30px;
        }

        .info {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 20px;
            width: 100%;
            max-width: 800px;
        }

        .info h3 {
            color: #32A473;
            margin-bottom: 10px;
            font-size: 1.4rem;
            text-align: center;
        }

        .info p {
            line-height: 1.6;
            text-align: center;
        }

        .board {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        #contenedor {
            display: grid;
            grid-template-columns: repeat(5, 70px);
            gap: 10px;
        }

        .celda {
            width: 70px;
            height: 70px;
            border-radius: 10px;
            border: 2px solid #555;
            background: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .celda img {
            width: 60px;
            height: 60px;
        }

        #teclado {
            display: grid;
            grid-template-columns: repeat(9, 60px);
            gap: 8px;
            margin-top: 20px;
        }

        .tecla {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-weight: bold;
            font-size: 1.2rem;
            transition: transform 0.4s ease-out, box-shadow 0.4s ease-out;
        }
        .tecla:hover {
            transform: translateY(-5px); 
            box-shadow: 0 12px 20px rgba(255, 153, 0, 0.6); 
        }
        .stats {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .ranking {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 25px;
        }

        .ranking h3 {
            color: #32A473;
            margin-bottom: 20px;
            font-size: 1.5rem;
            text-align: center;
        }

        .ranking-table {
            width: 100%;
            border-collapse: collapse;
        }

        .ranking-table th {
            text-align: left;
            padding: 12px 15px;
            border-bottom: 2px solid #32A473;
            font-size: 1.1rem;
        }

        .ranking-table td {
            padding: 12px 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .ranking-table tr:last-child td {
            border-bottom: none;
        }


        .timer {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 25px;
            text-align: center;
        }

        .timer h2 {
            color: #32A473;
            margin-bottom: 15px;
            font-size: 1.5rem;
        }

        #tiempo {
            font-size: 3rem;
            font-weight: bold;
            color: #FFD700;
            margin: 15px 0;
        }

        .streak {
            font-size: 1.3rem;
            margin: 15px 0;
        }

        #racha {
            color: #FFD700;
            font-weight: bold;
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

        footer {
            background: linear-gradient(to right, #32A473, #2A8C63);
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: auto;
        }

        .social {
            display: flex;
            gap: 15px;
        }

        .social img {
            width: 30px;
            height: 30px;
            cursor: pointer;
        }

        .auth {
            display: flex;
            gap: 20px;
        }

        .auth-item {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        .auth-item:hover {
            color: #FFD700;
        }

        .auth-item img {
            width: 20px;
            height: 20px;
        }

        @media (max-width: 1200px) {
            .main {
                flex-direction: column;
            }
            
            .stats {
                flex-direction: row;
            }
            
            .ranking, .timer {
                flex: 1;
            }
        }

        @media (max-width: 768px) {
            .stats {
                flex-direction: column;
            }
            
            #contenedor {
                grid-template-columns: repeat(5, 60px);
            }
            
            .celda {
                width: 60px;
                height: 60px;
            }
            
            .celda img {
                width: 50px;
                height: 50px;
            }
            
            #teclado {
                grid-template-columns: repeat(9, 50px);
            }
            
            .tecla {
                width: 50px;
                height: 50px;
                font-size: 1rem;
            }
        }
    </style>
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
                    </tr>
                    <tr>
                        <td>2#</td>
                    </tr>
                    <tr>
                        <td>3#</td>
                    </tr>
                    <tr>
                        <td>4#</td>
                    </tr>
                    <tr>
                        <td>5#</td>
                    </tr>
                </table>
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
                const respuesta = await fetch("http://185.60.43.155:3000/api/word/1");
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
            tiempo = 15;
            seg = 0;
            contTiempo.innerHTML = `${tiempo - seg}`;
            clearInterval(intervalo);
            intervalo = setInterval(() => {
                seg++;
                contTiempo.innerHTML = `${tiempo - seg}`;
                if (tiempo - seg === 0) {
                    clearInterval(intervalo);
                    palabra = "";
                    posicion.columna = 0;
                    posicion.fila++;
                    iniciarTiempo();
                }
                if (posicion.fila > 4) {
                    clearInterval(intervalo);
                    desactivarTeclado();
                    alert("Has perdido");
                    racha = 0;
                    contRacha.innerText = racha;
                    btnNuevaPartida.style.display = "block";
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
                posicion.fila++;
            }
        }

        function validarPalabra() {
            let aciertos = 0;
            palabra.split('').forEach((letraLingo, cont) => {
                let posicionLetra = document.getElementById(`CelPos${posicion.fila}${cont}`);
                if (!SECRETA.includes(letraLingo)) {
                    posicionLetra.style.backgroundColor = "#ff5252";
                } else if (SECRETA[cont] == letraLingo) {
                    posicionLetra.style.backgroundColor = "#4caf50";
                    aciertos++;
                } else {
                    posicionLetra.style.backgroundColor = "#ff9800";
                }
            });

            if (aciertos === SECRETA.length) {
                clearInterval(intervalo);
                desactivarTeclado();
                racha++;
                contRacha.innerText = racha;
                alert(`¡Felicidades! Has ganado\nRacha actual: ${racha}`);
                btnNuevaPartida.style.display = "block";
            } else {
                clearInterval(intervalo);
                iniciarTiempo();
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
            await obtenerPalabraSecreta();
            iniciarTiempo();
        }
        
        //--------------------Main
        iniciarJuego();


    </script>
</body>
</html>
