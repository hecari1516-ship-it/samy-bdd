<?php
require '../config.php';
requiereAdmin();
$raiz = '../';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar doctor · SaMy</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <?php include '../includes/nav.php'; ?>
  <div class="page-wrap" style="max-width:650px">
    <div class="eyebrow">Nuevo registro</div>
    <h1 class="page-title">Registrar doctor</h1>
    <div class="tarjeta">
      <form action="guardar.php" method="POST">
        <?= csrfCampo() ?>
        <div class="row g-3">
          <div class="col-md-6"><label class="form-label small fw-semibold">Nombre</label>
            <input type="text" name="nombre" class="form-control" maxlength="60" required></div>
          <div class="col-md-6"><label class="form-label small fw-semibold">Apellido</label>
            <input type="text" name="apellido" class="form-control" maxlength="60" required></div>
          <div class="col-md-6"><label class="form-label small fw-semibold">Especialidad</label>
            <input type="text" name="especialidad" class="form-control" maxlength="60"></div>
          <div class="col-md-6"><label class="form-label small fw-semibold">Teléfono</label>
            <input type="text" name="telefono" class="form-control" maxlength="15"></div>
          <div class="col-12"><label class="form-label small fw-semibold">Cédula profesional</label>
            <input type="text" name="cedula_prof" class="form-control" maxlength="20"></div>
        </div>
        <div class="mt-4 d-flex gap-2">
          <button type="submit" class="btn btn-samy">Guardar doctor</button>
          <a href="listar.php" class="btn btn-samy-outline">Cancelar</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
