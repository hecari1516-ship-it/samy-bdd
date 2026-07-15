<?php
require '../config.php';
requiereAdmin();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_paciente'])) {
    verificarCsrf();
    $id = (int) $_POST['id_paciente'];
    $stmt = $conn->prepare("DELETE FROM pacientes WHERE id_paciente = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    header('Location: listar.php?msg=eliminado');
    exit;
}
?>
