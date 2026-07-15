<?php
require 'config.php';

$mensaje = '';

$existe = $conn->query("SELECT COUNT(*) AS total FROM usuarios")->fetch_assoc();
if ($existe['total'] > 0) {
    requiereAdmin();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verificarCsrf();
    $usuario  = trim($_POST['usuario']);
    $password = $_POST['password'];
    $hash     = password_hash($password, PASSWORD_DEFAULT);

    $rol = ($_POST['rol'] === 'Medico') ? 'Medico' : 'Administrador';

    $stmt = $conn->prepare("INSERT INTO usuarios (usuario, password, rol) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $usuario, $hash, $rol);

    if ($stmt->execute()) {
        header('Location: login.php');
        exit;
    } else {
        $mensaje = 'Ese nombre de usuario ya existe. Intenta con otro.';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Crear administrador</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="login-wrap">
    <div class="login-tarjeta">
      <div class="eyebrow">Configuración inicial</div>
      <h2 class="page-title" style="margin-bottom:16px;">Crear administrador</h2>

      <?php if ($existe['total'] > 0): ?>
        <div class="alert alert-warning py-2 small">
          Ya existe <?= $existe['total'] ?> usuario(s) registrado(s). Como ya iniciaste sesión como Administrador,
          puedes crear otro usuario (Médico o Administrador) desde aquí.
        </div>
      <?php endif; ?>

      <?php if ($mensaje): ?>
        <div class="alert alert-danger py-2 small"><?= htmlspecialchars($mensaje) ?></div>
      <?php endif; ?>

      <form method="POST">
        <?= csrfCampo() ?>
        <div class="mb-3">
          <label class="form-label small fw-semibold">Usuario</label>
          <input type="text" name="usuario" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label small fw-semibold">Contraseña</label>
          <input type="password" name="password" class="form-control" required minlength="6">
        </div>
        <div class="mb-4">
          <label class="form-label small fw-semibold">Rol</label>
          <select name="rol" class="form-select">
            <option value="Administrador">Administrador</option>
            <option value="Medico">Médico</option>
          </select>
        </div>
        <button type="submit" class="btn btn-samy w-100">Crear usuario</button>
      </form>
    </div>
  </div>
</body>
</html>
