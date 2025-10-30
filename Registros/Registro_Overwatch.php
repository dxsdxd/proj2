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
  <title>Registro Overwatch 2 - Torneo Nexus</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@500&family=Poppins:wght@400;700&display=swap');

    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(160deg, #f0f0f0 0%, #101010 100%);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100vh;
      color: #333;
    }

    h1 {
      font-family: 'Orbitron', sans-serif;
      font-size: 2.8rem;
      color: #ff9c00;
      text-shadow: 0 0 10px #ff9c00;
      margin-bottom: 25px;
    }

    form {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
      padding: 30px;
      border-radius: 15px;
      border: 2px solid #ff9c00;
      box-shadow: 0 0 25px rgba(255, 156, 0, 0.3);
      width: 400px;
      color: #fff;
    }

    label {
      display: block;
      margin-top: 15px;
      font-weight: bold;
      color: #ffe1b0;
    }

    input,
    select {
      width: 100%;
      padding: 10px;
      border-radius: 8px;
      border: none;
      margin-top: 5px;
      background: #2e2e2e;
      color: #fff;
    }

    button {
      width: 100%;
      margin-top: 20px;
      padding: 12px;
      background: #ff9c00;
      border: none;
      border-radius: 10px;
      font-weight: bold;
      color: #fff;
      text-transform: uppercase;
      cursor: pointer;
      transition: 0.3s;
    }

    button:hover {
      background: #ffaa33;
      box-shadow: 0 0 20px #ff9c00;
    }

    a {
      color: #ff9c00;
      margin-top: 15px;
      display: inline-block;
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
  <h1>Registro Overwatch 2</h1>
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
    reg_usr($capitan, $contra, $equipo, $integrantes, $unis, $torneo, "equiposoverwatch");
  }
  ?>

  <a href="../index.php">⬅️ Regresar</a>
</body>

</html>