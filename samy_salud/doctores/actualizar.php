<?php
require '../config.php';
requiereAdmin();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verificarCsrf();
    $id = (int) $_POST['id_doctor'];
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $especialidad = trim($_POST['especialidad']);
    $telefono = trim($_POST['telefono']);
    $cedula_prof = trim($_POST['cedula_prof']);

    $stmt = $conn->prepare("UPDATE doctores SET nombre=?, apellido=?, especialidad=?, telefono=?, cedula_prof=? WHERE id_doctor=?");
    $stmt->bind_param("sssssi", $nombre, $apellido, $especialidad, $telefono, $cedula_prof, $id);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    header('Location: listar.php?msg=ok');
    exit;
}
?>
