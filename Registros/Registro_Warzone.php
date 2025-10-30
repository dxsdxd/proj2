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
  <title>Registro Warzone - Torneo Nexus</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Russo+One&family=Roboto:wght@400;700&display=swap');

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Roboto', sans-serif;
      background: url('/Fondos/warzone_bg.jpg') no-repeat center center/cover;
      background-attachment: fixed;
      color: #d4d4d4;
      height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      backdrop-filter: brightness(0.8);
    }

    h1 {
      font-family: 'Russo One', sans-serif;
      font-size: 2.5rem;
      color: #a2ff57;
      text-shadow: 0 0 15px #1a3d00;
      margin-bottom: 25px;
      letter-spacing: 2px;
    }

    form {
      background: rgba(20, 30, 20, 0.9);
      padding: 35px;
      border-radius: 12px;
      border: 2px solid #4d7031;
      box-shadow: 0 0 25px rgba(162, 255, 87, 0.2);
      width: 400px;
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    label {
      color: #b5ff9c;
      font-weight: 600;
      text-transform: uppercase;
      font-size: 0.9rem;
    }

    input,
    select {
      padding: 10px;
      border: none;
      border-radius: 6px;
      background: #2c2c2c;
      color: #fff;
      font-size: 1rem;
      outline: none;
    }

    input:focus,
    select:focus {
      border: 1px solid #a2ff57;
      box-shadow: 0 0 10px #a2ff57;
    }

    button {
      margin-top: 15px;
      padding: 12px;
      border: 2px solid #a2ff57;
      background: transparent;
      color: #a2ff57;
      font-weight: bold;
      text-transform: uppercase;
      border-radius: 8px;
      cursor: pointer;
      transition: 0.3s;
    }

    button:hover {
      background: #a2ff57;
      color: #111;
      box-shadow: 0 0 20px #a2ff57;
    }

    a {
      margin-top: 20px;
      color: #b5ff9c;
      text-decoration: none;
    }

    a:hover {
      text-shadow: 0 0 10px #a2ff57;
    }

    .mensaje {
      margin-top: 20px;
      font-weight: bold;
      color: #a2ff57;
      text-shadow: 0 0 8px #a2ff57;
    }
  </style>
</head>

<body>

  <h1>Registro Warzone</h1>

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
    reg_usr($capitan, $contra, $equipo, $integrantes, $unis, $torneo, "equiposwarzone");
  }
  ?>

</body>

</html>