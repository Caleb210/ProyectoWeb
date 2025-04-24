<?php
include 'conexion.php';

$idUsuario = $_POST['id_usuario'];
$idCandidato = $_POST['id_candidato'];

$sql = "INSERT INTO votos (id_usuario, id_candidato, fecha) VALUES (?, ?, NOW())";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $idUsuario, $idCandidato);

if ($stmt->execute()) {
    echo "Voto registrado";
} else {
    echo "Error al registrar voto: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
