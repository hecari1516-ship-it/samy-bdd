<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verificarCsrf();

    $usuario  = trim($_POST['usuario']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id_usuario, usuario, password, rol FROM usuarios WHERE usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $fila = $resultado->fetch_assoc();

        if (password_verify($password, $fila['password'])) {
            session_regenerate_id(true); // evita fijación de sesión
            unset($_SESSION['intentos_fallidos']);
            $_SESSION['usuario_id']     = $fila['id_usuario'];
            $_SESSION['usuario_nombre'] = $fila['usuario'];
            $_SESSION['usuario_rol']    = $fila['rol'];
            $_SESSION['mostrar_bienvenida'] = true;

            header('Location: index.php');
            exit;
        }
    }

    // Pequeña demora progresiva ante intentos fallidos (dificulta ataques de fuerza bruta)
    $_SESSION['intentos_fallidos'] = ($_SESSION['intentos_fallidos'] ?? 0) + 1;
    sleep(min($_SESSION['intentos_fallidos'], 3));

    header('Location: login.php?error=1');
    exit;
}
?>
