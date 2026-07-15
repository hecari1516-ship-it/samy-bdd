<?php
require 'config.php';
if (isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>SaMy · Iniciar sesión</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

  <div class="login-wrap">
    <div class="login-tarjeta">
      <div class="eyebrow">Hospital</div>
      <h2 class="page-title" style="margin-bottom:22px;">SaMy</h2>

      <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger py-2 small">Usuario o contraseña incorrectos.</div>
      <?php endif; ?>

      <form action="procesar_login.php" method="POST">
        <?= csrfCampo() ?>
        <div class="mb-3">
          <label class="form-label small fw-semibold">Usuario</label>
          <input type="text" name="usuario" class="form-control" required autofocus>
        </div>
        <div class="mb-4">
          <label class="form-label small fw-semibold">Contraseña</label>
          <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-samy w-100">Iniciar sesión</button>
      </form>

      <p class="text-center text-muted small mt-3 mb-0">
        ¿Primera vez? <a href="crear_admin.php">Crear usuario administrador</a>
      </p>
    </div>
  </div>

</body>
</html>
