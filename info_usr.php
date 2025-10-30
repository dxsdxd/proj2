<?php include('connDB/controladores.php'); session_start();?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark w-100">
        <div>
            <div class="collapse navbar-collapse" id="navbarContenido">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="menuDesplegable" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo htmlspecialchars($_SESSION['nombre_cap']); ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="menuDesplegable">
                            <li><a class="dropdown-item" href="index.php">pagina principal</a></li>
                            <li><a class="dropdown-item" href="info_usr.php">informacion cuenta</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="connDB/controlador_cerrarSesion.php">Salir</a></li>
                        </ul>
                    </li>
                </ul>
                <span class="navbar-text text-white me-3">
                    <?php echo "id: " . htmlspecialchars($_SESSION['id_capitan']); ?>
                </span>
            </div>
        </div>
    </nav>
    <?php echo "<h1>esto tendra algo en un futuro</h1>"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>