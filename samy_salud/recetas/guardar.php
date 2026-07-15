<?php
require '../config.php';
requiereLogin();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verificarCsrf();
    $id_cita = (int) $_POST['id_cita'];
    $medicamento = trim($_POST['medicamento']);
    $dosis = trim($_POST['dosis']);
    $indicaciones = trim($_POST['indicaciones']);

    $stmt = $conn->prepare("INSERT INTO recetas (id_cita, medicamento, dosis, indicaciones) VALUES (?,?,?,?)");
    $stmt->bind_param("isss", $id_cita, $medicamento, $dosis, $indicaciones);
    $stmt->execute();
    $nuevoId = $stmt->insert_id;
    $stmt->close();
    $conn->close();

    header('Location: ver.php?id=' . $nuevoId);
    exit;
}
?>
