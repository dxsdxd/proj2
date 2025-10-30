<?php 
/*
 * esto literalmente solo es la conexion a la base de datos.
 * ultimo cambio hecho por: Diego.
 * 23/10/2025 : 01:14 a.m.
 */
$host = "localhost";
$db = "torneo";
$user = "root";
$pass = "";
$port = "3306";

$conn = new mysqli($host, $user, $pass, $db, $port);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
$conn->set_charset("utf8");


 ?>