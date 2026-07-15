<?php
require '../config.php';
requiereAdmin();
$raiz = '../';

$id = (int) ($_GET['id'] ?? 0);
$stmt = $conn->prepare("SELECT * FROM pacientes WHERE id_paciente = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
if ($resultado->num_rows === 0) { header('Location: listar.php'); exit; }
$p = $resultado->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar paciente · SaMy</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <?php include '../includes/nav.php'; ?>

  <div class="page-wrap" style="max-width:700px">
    <div class="eyebrow">Editar registro #<?= $p['id_paciente'] ?></div>
    <h1 class="page-title">Modificar paciente</h1>

    <div class="tarjeta">
      <form action="actualizar.php" method="POST">
        <?= csrfCampo() ?>
        <input type="hidden" name="id_paciente" value="<?= $p['id_paciente'] ?>">
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label small fw-semibold">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($p['nombre']) ?>" required>
          </div>
          <div class="col-md-6">
            <label class="form-label small fw-semibold">Apellido</label>
            <input type="text" name="apellido" class="form-control" value="<?= htmlspecialchars($p['apellido']) ?>" required>
          </div>
          <div class="col-md-6">
            <label class="form-label small fw-semibold">Fecha de nacimiento</label>
            <input type="date" name="fecha_nacimiento" class="form-control" value="<?= $p['fecha_nacimiento'] ?>" required>
          </div>
          <div class="col-md-6">
            <label class="form-label small fw-semibold">Sexo</label>
            <select name="sexo" class="form-select" required>
              <?php foreach (['M'=>'Masculino','F'=>'Femenino','Otro'=>'Otro'] as $val=>$label): ?>
                <option value="<?= $val ?>" <?= $p['sexo']===$val?'selected':'' ?>><?= $label ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-6">
            <label class="form-label small fw-semibold">Teléfono</label>
            <input type="text" name="telefono" class="form-control" value="<?= htmlspecialchars($p['telefono']) ?>">
          </div>
          <div class="col-md-6">
            <label class="form-label small fw-semibold">Tipo de sangre</label>
            <input type="text" name="tipo_sangre" class="form-control" value="<?= htmlspecialchars($p['tipo_sangre']) ?>">
          </div>
          <div class="col-12">
            <label class="form-label small fw-semibold">Dirección</label>
            <input type="text" name="direccion" class="form-control" value="<?= htmlspecialchars($p['direccion']) ?>">
          </div>
        </div>
        <div class="mt-4 d-flex gap-2">
          <button type="submit" class="btn btn-samy">Guardar cambios</button>
          <a href="listar.php" class="btn btn-samy-outline">Cancelar</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
<?php $conn->close(); ?>
