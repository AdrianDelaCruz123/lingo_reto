//-----------------variables principales
    // aqui guardo la palabra secreta que viene de la api
    let SECRETA = "";
    // esta variable controla la posicion de la letra que el usuario esta escribiendo
    let posicion = {fila:0, columna:0};
    // esta guarda la palabra que el jugador va escribiendo
    let palabra = "";
    // contador de racha de victorias
    let racha = 0;
    // esto es para el temporizador
    let intervalo = null;
    let tiempo = 15;
    let seg = 0;

    //-----------------elementos del html
    // aqui pillo todos los elementos del dom que voy a usar
    const contTiempo = document.getElementById("tiempo");
    const contenedor = document.getElementById("contenedor");
    const teclado = document.getElementById("teclado");
    const contRacha = document.getElementById("racha");
    const btnNuevaPartida = document.getElementById("btnNuevaPartida");

    //----------------funciones

    // esta funcion pide la palabra secreta desde una api externa
    async function obtenerPalabraSecreta() {
        try {
            const respuesta = await fetch("http://185.60.43.155:3000/api/word/1");

            if (!respuesta.ok) {
                throw new Error("error al obtener la palabra: " + respuesta.status);
            }

            const data = await respuesta.json();
            SECRETA = (data.word || data.palabra || "").toUpperCase();

            if (!SECRETA) {
                throw new Error("la api no devolvio una palabra valida");
            }

            console.log("palabra secreta cargada:", SECRETA);
        } catch (error) {
            console.error("error al obtener la palabra secreta:", error);
            alert("no se pudo obtener la palabra secreta, se pone una por defecto");
            SECRETA = "SIFON";
        }
    }

    // esta funcion crea el tablero de 5x5 donde se muestran las letras
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

    // esta crea el teclado virtual con todas las letras
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

    // esta controla el tiempo de cada intento
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

    // esta se ejecuta cuando el jugador hace clic en una letra
    async function cambiarLetra(letra) {
        let letraPos = document.getElementById(`Pos${posicion.fila}${posicion.columna}`);
        letraPos.textContent = letra;
        palabra += letra;
        posicion.columna++;

        // si ya lleno las 5 letras, se valida la palabra
        if (posicion.columna > 4) {
            await validarPalabra();
            palabra = "";
            posicion.columna = 0;
        }
    }

    // esta valida si la palabra existe y si las letras coinciden con la secreta
    async function validarPalabra() {
        const existe = await verificarPalabraAPI(palabra.toLowerCase());
        clearInterval(intervalo);

        if (!existe) {
            alert("la palabra no existe");
            posicion.fila++;
            palabra = "";
            posicion.columna = 0;

            if (posicion.fila > 4) {
                desactivarTeclado();
                alert("has perdido, la palabra era: " + SECRETA);
                racha = 0;
                contRacha.innerText = racha;
                btnNuevaPartida.style.display = "block";
            } else {
                seg = 0;
                contTiempo.innerText = tiempo - seg;
                iniciarTiempo();
            }
            return;
        }

        // aqui se pintan las letras segun si estan bien o no
        let aciertos = 0;
        palabra.split('').forEach((letraLingo, cont) => {
            let celda = document.getElementById(`CelPos${posicion.fila}${cont}`);
            if (!SECRETA.includes(letraLingo)) {
                celda.style.backgroundColor = "#ff5252"; // rojo
            } else if (SECRETA[cont] === letraLingo) {
                celda.style.backgroundColor = "#4caf50"; // verde
                aciertos++;
            } else {
                celda.style.backgroundColor = "#ff9800"; // naranja
            }
        });

        // si acierta toda la palabra gana
        if (aciertos === SECRETA.length) {
            desactivarTeclado();
            racha++;
            contRacha.innerText = racha;
            alert(`felicidades has ganado\nracha actual: ${racha}`);
            btnNuevaPartida.style.display = "block";
        } else {
            posicion.fila++;
            palabra = "";
            posicion.columna = 0;
            if (posicion.fila > 4) {
                desactivarTeclado();
                alert("has perdido, la palabra era: " + SECRETA);
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

    // esta comprueba con la api si la palabra existe
    async function verificarPalabraAPI(palabraUsuario) {
        try {
            const respuesta = await fetch(`http://185.60.43.155:3000/api/check/${palabraUsuario}`);
            if (!respuesta.ok) throw new Error("error al verificar palabra");
            const data = await respuesta.json();
            return data.exists;
        } catch (error) {
            console.error("error api:", error);
            return false;
        }
    }

    // esta desactiva el teclado cuando termina la partida
    function desactivarTeclado() {
        const teclas = teclado.querySelectorAll(".tecla");
        teclas.forEach(tecla => {
            tecla.onclick = null;
            tecla.style.opacity = "0.5";
            tecla.style.cursor = "not-allowed";
        });
    }
    
    // esta empieza una nueva partida
    async function nuevaPartida() {
        posicion = { fila: 0, columna: 0 };
        palabra = "";
        crearTablero();
        crearTeclado();
        await obtenerPalabraSecreta(); 
        iniciarTiempo();
        btnNuevaPartida.style.display = "none";
    }
    
    // esta se ejecuta al cargar la pagina y arranca el juego
    async function iniciarJuego() {
        crearTablero();
        crearTeclado();
        iniciarTiempo();
        await obtenerPalabraSecreta();
    }
    
    //--------------------main
    // aqui llamo a la funcion principal para que empiece todo
    iniciarJuego();