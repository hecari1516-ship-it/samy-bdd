<?php
require '../config.php';
requiereAdmin();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verificarCsrf();
    $numero = trim($_POST['numero']);
    $tipo = $_POST['tipo'];
    $estado = $_POST['estado'];

    $stmt = $conn->prepare("INSERT INTO habitaciones (numero, tipo, estado) VALUES (?,?,?)");
    $stmt->bind_param("sss", $numero, $tipo, $estado);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    header('Location: listar.php?msg=ok');
    exit;
}
?>
