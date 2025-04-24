<?php
$servername = "localhost";
$username = "root"; 
$password = "";     
$database = "proyectovotacion"; // nombre con el que se importa el sql que pasó justin

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
