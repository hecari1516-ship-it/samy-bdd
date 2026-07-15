<?php
require '../config.php';
requiereAdmin();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_habitacion'])) {
    verificarCsrf();
    $id = (int) $_POST['id_habitacion'];
    $stmt = $conn->prepare("DELETE FROM habitaciones WHERE id_habitacion = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    header('Location: listar.php?msg=eliminado');
    exit;
}
?>
