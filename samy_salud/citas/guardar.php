<?php
require '../config.php';
requiereLogin();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verificarCsrf();
    $id_paciente = (int) $_POST['id_paciente'];
    $id_doctor = (int) $_POST['id_doctor'];
    $id_habitacion = (int) $_POST['id_habitacion'];
    $fecha_cita = str_replace('T', ' ', $_POST['fecha_cita']);
    $motivo = trim($_POST['motivo']);
    $estado = $_POST['estado'];

    $stmt = $conn->prepare(
        "INSERT INTO citas (id_paciente, id_doctor, id_habitacion, fecha_cita, motivo, estado) VALUES (?,?,?,?,?,?)"
    );
    $stmt->bind_param("iiisss", $id_paciente, $id_doctor, $id_habitacion, $fecha_cita, $motivo, $estado);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    header('Location: listar.php?msg=ok');
    exit;
}
?>
