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
  <title>Registro Fortnite - Torneo Nexus</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Luckiest+Guy&family=Poppins:wght@400;700&display=swap');

    body {
      font-family: 'Poppins', sans-serif;
      background: radial-gradient(circle, #1a001a 0%, #000 100%);
      color: #fff;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    h1 {
      font-family: 'Luckiest Guy', cursive;
      font-size: 3rem;
      color: #ff00ff;
      text-shadow: 0 0 30px #00ffff;
      margin-bottom: 25px;
    }

    form {
      background: rgba(0, 0, 0, 0.8);
      padding: 30px;
      border-radius: 20px;
      border: 2px solid #ff00ff;
      box-shadow: 0 0 25px #00ffff;
      width: 400px;
    }

    label {
      display: block;
      margin-top: 15px;
      font-weight: bold;
      color: #ffb7ff;
    }

    input,
    select {
      width: 100%;
      padding: 10px;
      border-radius: 8px;
      border: none;
      margin-top: 5px;
      background: #151515;
      color: #fff;
    }

    button {
      width: 100%;
      margin-top: 20px;
      padding: 12px;
      background: linear-gradient(45deg, #ff00ff, #00ffff);
      border: none;
      border-radius: 10px;
      font-weight: bold;
      color: #000;
      text-transform: uppercase;
      cursor: pointer;
      transition: 0.3s;
    }

    button:hover {
      transform: scale(1.05);
      box-shadow: 0 0 25px #00ffff;
    }

    a {
      color: #00ffff;
      margin-top: 15px;
      text-decoration: none;
    }

    .mensaje {
      margin-top: 20px;
      font-weight: bold;
      color: #00ff7f;
      text-shadow: 0 0 8px #00ff7f;
    }
  </style>
</head>

<body>
  <h1>Registro Fortnitemares</h1>
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
    reg_usr($capitan, $contra, $equipo, $integrantes, $unis, $torneo, "equiposfornite");
  }
  ?>

  <a href="../index.php">⬅️ Regresar</a>
</body>

</html>