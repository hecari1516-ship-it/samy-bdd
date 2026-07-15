<?php
require '../config.php';
requiereAdmin();
$raiz = '../';
$id = (int) ($_GET['id'] ?? 0);
$stmt = $conn->prepare("SELECT * FROM habitaciones WHERE id_habitacion = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
if ($resultado->num_rows === 0) { header('Location: listar.php'); exit; }
$h = $resultado->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar habitación · SaMy</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <?php include '../includes/nav.php'; ?>
  <div class="page-wrap" style="max-width:600px">
    <div class="eyebrow">Editar registro #<?= $h['id_habitacion'] ?></div>
    <h1 class="page-title">Modificar habitación</h1>
    <div class="tarjeta">
      <form action="actualizar.php" method="POST">
        <?= csrfCampo() ?>
        <input type="hidden" name="id_habitacion" value="<?= $h['id_habitacion'] ?>">
        <div class="row g-3">
          <div class="col-md-6"><label class="form-label small fw-semibold">Número</label>
            <input type="text" name="numero" class="form-control" value="<?= htmlspecialchars($h['numero']) ?>" required></div>
          <div class="col-md-6"><label class="form-label small fw-semibold">Tipo</label>
            <select name="tipo" class="form-select" required>
              <?php foreach (['General','Privada','Terapia Intensiva','Urgencias'] as $t): ?>
                <option value="<?= $t ?>" <?= $h['tipo']===$t?'selected':'' ?>><?= $t ?></option>
              <?php endforeach; ?>
            </select></div>
          <div class="col-md-6"><label class="form-label small fw-semibold">Estado</label>
            <select name="estado" class="form-select" required>
              <?php foreach (['Disponible','Ocupada','Mantenimiento'] as $e): ?>
                <option value="<?= $e ?>" <?= $h['estado']===$e?'selected':'' ?>><?= $e ?></option>
              <?php endforeach; ?>
            </select></div>
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
