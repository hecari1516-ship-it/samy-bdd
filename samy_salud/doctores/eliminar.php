<?php
require '../config.php';
requiereAdmin();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_doctor'])) {
    verificarCsrf();
    $id = (int) $_POST['id_doctor'];
    $stmt = $conn->prepare("DELETE FROM doctores WHERE id_doctor = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    header('Location: listar.php?msg=eliminado');
    exit;
}
?>
