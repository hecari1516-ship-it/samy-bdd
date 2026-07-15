<?php
require '../config.php';
requiereAdmin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verificarCsrf();
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $sexo = $_POST['sexo'];
    $telefono = trim($_POST['telefono']);
    $direccion = trim($_POST['direccion']);
    $tipo_sangre = trim($_POST['tipo_sangre']);

    $stmt = $conn->prepare(
        "INSERT INTO pacientes (nombre, apellido, fecha_nacimiento, sexo, telefono, direccion, tipo_sangre)
         VALUES (?, ?, ?, ?, ?, ?, ?)"
    );
    $stmt->bind_param("sssssss", $nombre, $apellido, $fecha_nacimiento, $sexo, $telefono, $direccion, $tipo_sangre);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    header('Location: listar.php?msg=ok');
    exit;
}
?>
