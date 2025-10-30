<?php include('connDB/controladores.php'); ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Torneo Nexus</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    
    <div class="fondo">
        <div class="circulo c1"></div>
        <div class="circulo c2"></div>
        <div class="circulo c3"></div>
    </div>

    <header class="titulo">
        <h1>🏆 TORNEO NEXUS 🏆</h1>
    </header>

    <div class="contenedor">
        <div class="panel reglas">
            <h2>Reglas y Condiciones</h2>
            <p>
                1. Cada capitán solo puede registrar un equipo.<br>
                2. Máximo 8 equipos por videojuego.<br>
                3. Se debe respetar la organización y los horarios.<br>
                4. Prohibido el uso de trampas o hacks.<br>
                5. La organización se reserva el derecho de descalificación.<br>
                6. Se deberá mantener el respeto entre los equipos.<br>
                7. El incumplimiento de reglas conllevará descalificación inmediata.<br>
                <b>8. Solo el líder podrá acceder al registro de los equipos así para evitar problemáticas dentro del sistema y evitar que se sabotee el juego.</b>
            </p>
        </div>

        <div class="panel login">
            <h2>Inicio de Sesión</h2>
            <form method="post" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                <input type="text" placeholder="Usuario" class="campo" name="usuario">
                <input type="password" placeholder="Contraseña" class="campo" name="pass">
                <button class="btn" name="btnIngresar">Siguiente</button><br>
            </form>
            <?php
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                $nombre =  $_POST['usuario'];
                $contra =  $_POST['pass'];
                ing_usr($nombre, $contra);
            }
            ?>
        </div>
    </div>

    <footer class="pie">
        <p>Cualquier duda o apoyo favor de comunicarte a 
        <a href="mailto:torneonexusapoyo@gmail.com">torneonexusapoyo@gmail.com</a></p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
