<?php
require '../config.php';
requiereAdmin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verificarCsrf();
    $id = (int) $_POST['id_paciente'];
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $sexo = $_POST['sexo'];
    $telefono = trim($_POST['telefono']);
    $direccion = trim($_POST['direccion']);
    $tipo_sangre = trim($_POST['tipo_sangre']);

    $stmt = $conn->prepare(
        "UPDATE pacientes SET nombre=?, apellido=?, fecha_nacimiento=?, sexo=?, telefono=?, direccion=?, tipo_sangre=?
         WHERE id_paciente=?"
    );
    $stmt->bind_param("sssssssi", $nombre, $apellido, $fecha_nacimiento, $sexo, $telefono, $direccion, $tipo_sangre, $id);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    header('Location: listar.php?msg=ok');
    exit;
}
?>
