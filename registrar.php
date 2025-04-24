<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "ProyectoVotacion";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$cedula = $_POST['cedula'];
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$provincia = $_POST['provincia'];
$contrasena = password_hash($_POST['contrasena'], PASSWORD_BCRYPT); // Encriptar contraseña

// Validar si ya existe esa cédula
$sql_check = "SELECT * FROM usuarios WHERE cedula = ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("s", $cedula);
$stmt_check->execute();
$result = $stmt_check->get_result();

if ($result->num_rows > 0) {
    echo "Ya existe un usuario registrado con esta cédula.";
} else {
    $sql = "INSERT INTO usuarios (cedula, nombre, apellidos, provincia, contrasena) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $cedula, $nombre, $apellidos, $provincia, $contrasena);

    if ($stmt->execute()) {
        echo "Registro exitoso. <a href='indexLogin.html'>Iniciar sesión</a>";
    } else {
        echo "Error al registrar: " . $stmt->error;
    }
}

$conn->close();
?>
