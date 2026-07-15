<?php
require '../config.php';
requiereAdmin();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verificarCsrf();
    $id = (int) $_POST['id_habitacion'];
    $numero = trim($_POST['numero']);
    $tipo = $_POST['tipo'];
    $estado = $_POST['estado'];

    $stmt = $conn->prepare("UPDATE habitaciones SET numero=?, tipo=?, estado=? WHERE id_habitacion=?");
    $stmt->bind_param("sssi", $numero, $tipo, $estado, $id);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    header('Location: listar.php?msg=ok');
    exit;
}
?>
