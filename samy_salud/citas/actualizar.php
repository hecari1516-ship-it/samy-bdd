<?php
require '../config.php';
requiereAdmin();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verificarCsrf();
    $id = (int) $_POST['id_cita'];
    $id_paciente = (int) $_POST['id_paciente'];
    $id_doctor = (int) $_POST['id_doctor'];
    $id_habitacion = (int) $_POST['id_habitacion'];
    $fecha_cita = str_replace('T', ' ', $_POST['fecha_cita']);
    $motivo = trim($_POST['motivo']);
    $estado = $_POST['estado'];

    $stmt = $conn->prepare(
        "UPDATE citas SET id_paciente=?, id_doctor=?, id_habitacion=?, fecha_cita=?, motivo=?, estado=? WHERE id_cita=?"
    );
    $stmt->bind_param("iiisssi", $id_paciente, $id_doctor, $id_habitacion, $fecha_cita, $motivo, $estado, $id);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    header('Location: listar.php?msg=ok');
    exit;
}
?>
