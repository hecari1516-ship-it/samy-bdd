<?php
require '../config.php';
requiereAdmin();
$raiz = '../';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar paciente · SaMy</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <?php include '../includes/nav.php'; ?>

  <div class="page-wrap" style="max-width:700px">
    <div class="eyebrow">Nuevo ingreso</div>
    <h1 class="page-title">Registrar paciente</h1>

    <div class="tarjeta">
      <form action="guardar.php" method="POST">
        <?= csrfCampo() ?>
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label small fw-semibold">Nombre</label>
            <input type="text" name="nombre" class="form-control" maxlength="60" required>
          </div>
          <div class="col-md-6">
            <label class="form-label small fw-semibold">Apellido</label>
            <input type="text" name="apellido" class="form-control" maxlength="60" required>
          </div>
          <div class="col-md-6">
            <label class="form-label small fw-semibold">Fecha de nacimiento</label>
            <input type="date" name="fecha_nacimiento" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label class="form-label small fw-semibold">Sexo</label>
            <select name="sexo" class="form-select" required>
              <option value="M">Masculino</option>
              <option value="F">Femenino</option>
              <option value="Otro">Otro</option>
            </select>
          </div>
          <div class="col-md-6">
            <label class="form-label small fw-semibold">Teléfono</label>
            <input type="text" name="telefono" class="form-control" maxlength="15">
          </div>
          <div class="col-md-6">
            <label class="form-label small fw-semibold">Tipo de sangre</label>
            <input type="text" name="tipo_sangre" class="form-control" maxlength="5" placeholder="Ej. O+">
          </div>
          <div class="col-12">
            <label class="form-label small fw-semibold">Dirección</label>
            <input type="text" name="direccion" class="form-control" maxlength="150">
          </div>
        </div>
        <div class="mt-4 d-flex gap-2">
          <button type="submit" class="btn btn-samy">Guardar paciente</button>
          <a href="listar.php" class="btn btn-samy-outline">Cancelar</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
