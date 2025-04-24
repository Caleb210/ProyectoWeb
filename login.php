<?php
$conexion = new mysqli("localhost", "root", "", "ProyectoVotacion");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$cedula = $_POST['id'];
$contrasena = $_POST['password'];

$sql = "SELECT * FROM usuarios WHERE cedula = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $cedula);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) {
    $usuario = $resultado->fetch_assoc();

    if (password_verify($contrasena, $usuario['contrasena'])) {
        // Inicio de sesión exitoso
        session_start();
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nombre'] = $usuario['nombre'];
        header("Location: Soporte.html");
        exit;
    } else {
        echo "<script>alert('Contraseña incorrecta'); window.location.href='indexLogin.html';</script>";
    }
} else {
    echo "<script>alert('Cédula no registrada'); window.location.href='indexLogin.html';</script>";
}

$stmt->close();
$conexion->close();
?>

