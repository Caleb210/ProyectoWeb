<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    echo "<script>alert('Debe iniciar sesión primero.'); window.location.href='indexLogin.html';</script>";
    exit;
}

$conexion = new mysqli("localhost", "root", "", "ProyectoVotacion");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$id_usuario = $_SESSION['usuario_id'];
$candidato = $_POST['candidato'] ?? '';

// Verificar si ya votó
$sql_check = "SELECT * FROM votos WHERE id_usuario = ?";
$stmt_check = $conexion->prepare($sql_check);
$stmt_check->bind_param("i", $id_usuario);
$stmt_check->execute();
$result = $stmt_check->get_result();

if ($result->num_rows > 0) {
    echo "<script>alert('Ya ha votado. No puede hacerlo nuevamente.'); window.location.href='Soporte.html';</script>";
} else {
    $sql_insert = "INSERT INTO votos (id_usuario, candidato) VALUES (?, ?)";
    $stmt_insert = $conexion->prepare($sql_insert);
    $stmt_insert->bind_param("is", $id_usuario, $candidato);

    if ($stmt_insert->execute()) {
        echo "<script>alert('¡Voto registrado exitosamente!'); window.location.href='Soporte.html';</script>";
    } else {
        echo "<script>alert('Error al registrar el voto.'); window.location.href='Soporte.html';</script>";
    }

    $stmt_insert->close();
}

$stmt_check->close();
$conexion->close();
?>

