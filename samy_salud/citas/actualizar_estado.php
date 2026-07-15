<?php
require '../config.php';
requiereLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verificarCsrf();

    $id = (int) ($_POST['id_cita'] ?? 0);
    $estado = $_POST['estado'] ?? '';
    $validos = ['Programada', 'Atendida', 'Cancelada'];

    if ($id > 0 && in_array($estado, $validos, true)) {
        $stmt = $conn->prepare("UPDATE citas SET estado = ? WHERE id_cita = ?");
        $stmt->bind_param("si", $estado, $id);
        $stmt->execute();
        $stmt->close();
        http_response_code(200);
        echo 'ok';
    } else {
        http_response_code(400);
        echo 'datos inválidos';
    }
}
$conn->close();
?>
