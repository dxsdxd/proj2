<?php
include("../connDB/controladores.php");
$universidades = array(
  "upvm" => 1,
  "etac" => 2,
  "uam" => 3,
  "ipn" => 4,
  "unam" => 5,
  "tesco" => 6,
  "uvm" => 7,
  "utc" => 8
);
$tipos = array("Local" => 1, "Nexus" => 2);
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro Marvel Rivals - Torneo Nexus</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Anton&family=Poppins:wght@500&display=swap');

    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #0a0a0a 0%, #1a0000 100%);
      color: #fff;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-image: url('/Fondos/marvel_bg.jpg');
      background-size: cover;
      background-position: center;
      backdrop-filter: brightness(0.8);
    }

    h1 {
      font-family: 'Anton', sans-serif;
      font-size: 3rem;
      color: #ff2d2d;
      text-shadow: 0 0 20px #ff0000, 0 0 40px #0055ff;
      margin-bottom: 25px;
      letter-spacing: 2px;
    }

    form {
      background: rgba(10, 10, 10, 0.9);
      padding: 35px;
      border-radius: 15px;
      border: 3px solid #ff2d2d;
      box-shadow: 0 0 30px #0055ff;
      width: 400px;
    }

    label {
      display: block;
      margin-top: 15px;
      font-weight: bold;
      color: #ffaaaa;
    }

    input,
    select {
      width: 100%;
      padding: 10px;
      border-radius: 6px;
      border: none;
      margin-top: 5px;
      background: #181818;
      color: #fff;
    }

    button {
      width: 100%;
      margin-top: 20px;
      padding: 12px;
      background: linear-gradient(90deg, #ff0000, #0044ff);
      border: none;
      border-radius: 8px;
      color: #fff;
      font-weight: bold;
      text-transform: uppercase;
      cursor: pointer;
      transition: 0.3s;
    }

    button:hover {
      transform: scale(1.05);
      box-shadow: 0 0 25px #ff2d2d;
    }

    a {
      color: #00aaff;
      margin-top: 15px;
      text-decoration: none;
    }
  </style>
</head>

<body>

  <h1>Registro Marvel Rivals</h1>

  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label>Nombre del Equipo:</label>
    <input type="text" name="nombre_equipo" required>

    <label>Nombre del capitan:</label>
    <input type="text" name="nombre_cap" required>

    <label>Contasea del capitan:</label>
    <input type="password" name="contra_cap" required>

    <label>Integrantes:</label>
    <input type="text" name="integrantes" required>

    <label>Universidad:</label>
    <select name="universidad" required>
      <option>Selecciona una...</option>
      <?php foreach ($universidades as $c => $vv): ?>
        <option value="<?= $vv ?>"><?= strtoupper($c) ?></option>
      <?php endforeach; ?>
    </select>

    <label>Torneo:</label>
    <select name="torneo" required>
      <?php foreach ($tipos as $t => $v): ?>
        <option value="<?= $v ?>"><?= ucfirst($t) ?></option>
      <?php endforeach; ?>
    </select>

    <button type="submit">Registrar Equipo</button>
  </form>
  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $equipo = filter_input(INPUT_POST, 'nombre_equipo', FILTER_SANITIZE_SPECIAL_CHARS);
    $capitan = filter_input(INPUT_POST, 'nombre_cap', FILTER_SANITIZE_SPECIAL_CHARS);
    $contra = password_hash($_POST['contra_cap'], PASSWORD_DEFAULT);
    $integrantes = trim(filter_input(INPUT_POST, 'integrantes', FILTER_SANITIZE_SPECIAL_CHARS));
    $unis = $_POST['universidad'];
    $torneo = $_POST['torneo'];
    reg_usr($capitan, $contra, $equipo, $integrantes, $unis, $torneo, "equiposmarvel");
  }
  ?>

  <a href="../index.php">⬅️ Regresar</a>

</body>

</html>