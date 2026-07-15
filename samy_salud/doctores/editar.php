<?php
require '../config.php';
requiereAdmin();
$raiz = '../';
$id = (int) ($_GET['id'] ?? 0);
$stmt = $conn->prepare("SELECT * FROM doctores WHERE id_doctor = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
if ($resultado->num_rows === 0) { header('Location: listar.php'); exit; }
$d = $resultado->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar doctor · SaMy</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <?php include '../includes/nav.php'; ?>
  <div class="page-wrap" style="max-width:650px">
    <div class="eyebrow">Editar registro #<?= $d['id_doctor'] ?></div>
    <h1 class="page-title">Modificar doctor</h1>
    <div class="tarjeta">
      <form action="actualizar.php" method="POST">
        <?= csrfCampo() ?>
        <input type="hidden" name="id_doctor" value="<?= $d['id_doctor'] ?>">
        <div class="row g-3">
          <div class="col-md-6"><label class="form-label small fw-semibold">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($d['nombre']) ?>" required></div>
          <div class="col-md-6"><label class="form-label small fw-semibold">Apellido</label>
            <input type="text" name="apellido" class="form-control" value="<?= htmlspecialchars($d['apellido']) ?>" required></div>
          <div class="col-md-6"><label class="form-label small fw-semibold">Especialidad</label>
            <input type="text" name="especialidad" class="form-control" value="<?= htmlspecialchars($d['especialidad']) ?>"></div>
          <div class="col-md-6"><label class="form-label small fw-semibold">Teléfono</label>
            <input type="text" name="telefono" class="form-control" value="<?= htmlspecialchars($d['telefono']) ?>"></div>
          <div class="col-12"><label class="form-label small fw-semibold">Cédula profesional</label>
            <input type="text" name="cedula_prof" class="form-control" value="<?= htmlspecialchars($d['cedula_prof']) ?>"></div>
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
