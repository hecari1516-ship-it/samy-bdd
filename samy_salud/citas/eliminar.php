<?php
require '../config.php';
requiereAdmin();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_cita'])) {
    verificarCsrf();
    $id = (int) $_POST['id_cita'];
    $stmt = $conn->prepare("DELETE FROM citas WHERE id_cita = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    header('Location: listar.php?msg=eliminado');
    exit;
}
?>
