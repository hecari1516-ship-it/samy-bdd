<?php
require '../config.php';
requiereAdmin();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verificarCsrf();
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $especialidad = trim($_POST['especialidad']);
    $telefono = trim($_POST['telefono']);
    $cedula_prof = trim($_POST['cedula_prof']);

    $stmt = $conn->prepare("INSERT INTO doctores (nombre, apellido, especialidad, telefono, cedula_prof) VALUES (?,?,?,?,?)");
    $stmt->bind_param("sssss", $nombre, $apellido, $especialidad, $telefono, $cedula_prof);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    header('Location: listar.php?msg=ok');
    exit;
}
?>
