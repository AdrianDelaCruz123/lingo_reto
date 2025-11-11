proyecto: lingo
autor: alumno de 2daw
fecha: 2025

------------------------------------------------------------
descripcion del proyecto
------------------------------------------------------------
lingo es un juego tipo wordle hecho con laravel y blade. el usuario tiene que adivinar una palabra secreta letra por letra. el juego usa colores para mostrar si las letras estan bien colocadas o no. tambien tiene un sistema de tiempo y racha de aciertos.

la aplicacion funciona dentro de docker, con un contenedor para la web (php + apache), otro para la base de datos (mysql) y otro para phpmyadmin.

------------------------------------------------------------
estructura principal
------------------------------------------------------------
src/
├── app/                -> logica de laravel
├── public/             -> donde se carga la web (index.php, css, js, imagenes)
├── resources/views/    -> vistas blade, como lingo.blade.php
├── routes/             -> rutas de laravel
├── storage/            -> archivos temporales y logs
├── vendor/             -> dependencias de composer
└── ...

ademas hay una carpeta llamada sites/ que contiene la configuracion del host virtual para apache (lingo.conf).

------------------------------------------------------------
docker compose
------------------------------------------------------------
el proyecto usa docker compose con tres servicios:

- app: ejecuta php 8 con apache y el proyecto laravel
- db: base de datos mysql
- phpmyadmin: panel para ver la base de datos desde el navegador

los volumenes sincronizan la carpeta src del proyecto con /var/www/html dentro del contenedor.

------------------------------------------------------------
como levantar el proyecto
------------------------------------------------------------
1. abrir una terminal en la carpeta del proyecto
2. ejecutar el comando:
   docker compose up -d
3. esperar a que se construyan los contenedores
4. entrar en el navegador y abrir:
   http://localhost:8080
   para ver la aplicacion
5. para phpmyadmin abrir:
   http://localhost:8081
   usuario: root
   contraseña: root

------------------------------------------------------------
configuracion del host virtual (opcional)
------------------------------------------------------------
si se quiere acceder escribiendo lingo.local, se puede añadir esta linea al archivo hosts del sistema:

127.0.0.1 lingo.local

y luego abrir en el navegador:
http://lingo.local:8080

------------------------------------------------------------
separacion del script js
------------------------------------------------------------
el juego usa un archivo javascript llamado lingo.js que esta guardado en public/js/.
en la vista blade se carga asi:

<script src="{{ asset('js/lingo.js') }}"></script>

esto permite mantener el codigo html limpio y el javascript separado.

------------------------------------------------------------
como parar los contenedores
------------------------------------------------------------
para detener todo se usa:
docker compose down

si se quiere volver a construir desde cero:
docker compose up -d --build

------------------------------------------------------------
notas finales
------------------------------------------------------------
- el proyecto usa laravel breeze para la autenticacion (registro, login, logout).
- el juego se comunica con una api externa para obtener la palabra secreta.
- todo el codigo esta comentado de forma sencilla para entender su logica.
- si algo no carga, revisar permisos o reiniciar el contenedor de apache.
