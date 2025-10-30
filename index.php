<?php
session_start();

if (!isset($_SESSION['id_capitan']) || !isset($_SESSION['nombre_cap'])) {
  header("Location: login.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Torneo Nexus</title>
  <style>
    body {
      margin: 0;
      font-family: 'Trebuchet MS', sans-serif;
      background: radial-gradient(circle at center, #1a0000 0%, #000000 100%);
      color: #f1c40f;
      display: flex;
      flex-direction: column;
      align-items: center;
      min-height: 100vh;
    }

    h1 {
      text-align: center;
      font-size: 3rem;
      color: #ff0000;
      text-shadow: 0 0 20px #ff0000, 0 0 40px #660000;
      margin: 30px 0;
    }

    .contenedor-juegos {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 50px;
      max-width: 1000px;
      margin-bottom: 60px;
      justify-items: center;
    }

    .juego {
      position: relative;
      width: 420px;
      height: 260px;
      border: 3px solid #ff0000;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 0 15px #ff0000;
      cursor: pointer;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .juego:hover {
      transform: translateY(-8px) scale(1.03);
      box-shadow: 0 0 25px #ff6600;
    }

    .juego img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
      transition: opacity 0.3s ease;
    }

    .overlay {
      position: absolute;
      bottom: -100%;
      left: 0;
      width: 100%;
      height: 35%;
      background: rgba(0, 0, 0, 0.85);
      color: #ffcc00;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      font-size: 1.4rem;
      letter-spacing: 1px;
      transition: bottom 0.4s ease;
      border-top: 2px solid #ff0000;
      text-shadow: 0 0 10px #ff0000;
    }

    .juego:hover .overlay {
      bottom: 0;
    }

    footer {
      width: 100%;
      text-align: center;
      padding: 20px 0;
      background-color: #111;
      border-top: 2px solid #ff0000;
      color: #ccc;
      font-size: 0.9rem;
      margin-top: auto;
    }

    footer a {
      color: #ff9900;
      text-decoration: none;
    }

    footer a:hover {
      text-decoration: underline;
    }
  </style>
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

  <h1>🔥 TORNEO NEXUS 🔥</h1>

  <div class="contenedor-juegos">
    <a href="Warzone.html" class="juego">
      <img src="imagenes/Warzone.jpeg" alt="Warzone" />
      <div class="overlay">Warzone</div>
    </a>

    <a href="Overwatch.html" class="juego">
      <img src="imagenes/Overwatch.jpg" alt="Overwatch" />
      <div class="overlay">Overwatch</div>
    </a>

    <a href="MarvelRivals.html" class="juego">
      <img src="imagenes/Marvel_Rivals.jpeg" alt="Marvel Rivals" />
      <div class="overlay">Marvel Rivals</div>
    </a>

    <a href="Fortnite.html" class="juego">
      <img src="imagenes/Fortnite.jpeg" alt="Fortnite" />
      <div class="overlay">Fortnite</div>
    </a>
  </div>

  <footer>
    <p>
      Cualquier duda o apoyo favor de comunicarte a
      <a href="mailto:torneonexusapoyo@gmail.com">torneonexusapoyo@gmail.com</a>
    </p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>