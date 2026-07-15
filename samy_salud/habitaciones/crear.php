<?php
require '../config.php';
requiereAdmin();
$raiz = '../';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar habitación · SaMy</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <?php include '../includes/nav.php'; ?>
  <div class="page-wrap" style="max-width:600px">
    <div class="eyebrow">Nuevo registro</div>
    <h1 class="page-title">Registrar habitación</h1>
    <div class="tarjeta">
      <form action="guardar.php" method="POST">
        <?= csrfCampo() ?>
        <div class="row g-3">
          <div class="col-md-6"><label class="form-label small fw-semibold">Número</label>
            <input type="text" name="numero" class="form-control" maxlength="10" required></div>
          <div class="col-md-6"><label class="form-label small fw-semibold">Tipo</label>
            <select name="tipo" class="form-select" required>
              <option value="General">General</option>
              <option value="Privada">Privada</option>
              <option value="Terapia Intensiva">Terapia Intensiva</option>
              <option value="Urgencias">Urgencias</option>
            </select></div>
          <div class="col-md-6"><label class="form-label small fw-semibold">Estado</label>
            <select name="estado" class="form-select" required>
              <option value="Disponible">Disponible</option>
              <option value="Ocupada">Ocupada</option>
              <option value="Mantenimiento">Mantenimiento</option>
            </select></div>
        </div>
        <div class="mt-4 d-flex gap-2">
          <button type="submit" class="btn btn-samy">Guardar habitación</button>
          <a href="listar.php" class="btn btn-samy-outline">Cancelar</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
