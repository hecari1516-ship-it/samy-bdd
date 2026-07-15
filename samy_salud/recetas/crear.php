<?php
require '../config.php';
requiereLogin();
$raiz = '../';

$sqlCitas = "SELECT c.id_cita, c.fecha_cita, p.nombre AS p_nombre, p.apellido AS p_apellido,
                    d.nombre AS d_nombre, d.apellido AS d_apellido
             FROM citas c
             INNER JOIN pacientes p ON c.id_paciente = p.id_paciente
             INNER JOIN doctores d ON c.id_doctor = d.id_doctor
             ORDER BY c.fecha_cita DESC";
$citas = $conn->query($sqlCitas);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Generar receta · SaMy</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <?php include '../includes/nav.php'; ?>
  <div class="page-wrap" style="max-width:650px">
    <div class="eyebrow">Nueva receta</div>
    <h1 class="page-title">Generar receta médica</h1>

    <div class="tarjeta">
      <form action="guardar.php" method="POST">
        <?= csrfCampo() ?>
        <div class="row g-3">
          <div class="col-12">
            <label class="form-label small fw-semibold">Cita</label>
            <select name="id_cita" class="form-select" required>
              <option value="" disabled selected>Selecciona una cita</option>
              <?php while ($c = $citas->fetch_assoc()): ?>
                <option value="<?= $c['id_cita'] ?>">
                  #<?= $c['id_cita'] ?> — <?= htmlspecialchars($c['p_nombre'].' '.$c['p_apellido']) ?>
                  con Dr(a). <?= htmlspecialchars($c['d_nombre'].' '.$c['d_apellido']) ?>
                  (<?= htmlspecialchars(date('d/m/Y', strtotime($c['fecha_cita']))) ?>)
                </option>
              <?php endwhile; ?>
            </select>
          </div>
          <div class="col-12">
            <label class="form-label small fw-semibold">Medicamento</label>
            <input type="text" name="medicamento" class="form-control" maxlength="100" required>
          </div>
          <div class="col-md-6">
            <label class="form-label small fw-semibold">Dosis</label>
            <input type="text" name="dosis" class="form-control" maxlength="60" placeholder="Ej. 500mg cada 8 horas">
          </div>
          <div class="col-12">
            <label class="form-label small fw-semibold">Indicaciones</label>
            <textarea name="indicaciones" class="form-control" rows="3" maxlength="200"></textarea>
          </div>
        </div>
        <div class="mt-4 d-flex gap-2">
          <button type="submit" class="btn btn-samy">Guardar receta</button>
          <a href="listar.php" class="btn btn-samy-outline">Cancelar</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
<?php $conn->close(); ?>
