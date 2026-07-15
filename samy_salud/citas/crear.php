<?php
require '../config.php';
requiereLogin();
$raiz = '../';

$pacientes = $conn->query("SELECT id_paciente, nombre, apellido FROM pacientes ORDER BY nombre");
$doctores = $conn->query("SELECT id_doctor, nombre, apellido, especialidad FROM doctores ORDER BY nombre");
$habitaciones = $conn->query("SELECT id_habitacion, numero, tipo FROM habitaciones ORDER BY numero");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Agendar cita · SaMy</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <?php include '../includes/nav.php'; ?>
  <div class="page-wrap" style="max-width:650px">
    <div class="eyebrow">Nueva cita</div>
    <h1 class="page-title">Agendar cita</h1>

    <div class="tarjeta">
      <form action="guardar.php" method="POST">
        <?= csrfCampo() ?>
        <div class="row g-3">
          <div class="col-12">
            <label class="form-label small fw-semibold">Paciente</label>
            <select name="id_paciente" class="form-select" required>
              <option value="" disabled selected>Selecciona un paciente</option>
              <?php while ($p = $pacientes->fetch_assoc()): ?>
                <option value="<?= $p['id_paciente'] ?>"><?= htmlspecialchars($p['nombre'].' '.$p['apellido']) ?></option>
              <?php endwhile; ?>
            </select>
          </div>
          <div class="col-12">
            <label class="form-label small fw-semibold">Doctor</label>
            <select name="id_doctor" class="form-select" required>
              <option value="" disabled selected>Selecciona un doctor</option>
              <?php while ($d = $doctores->fetch_assoc()): ?>
                <option value="<?= $d['id_doctor'] ?>">Dr(a). <?= htmlspecialchars($d['nombre'].' '.$d['apellido']) ?> — <?= htmlspecialchars($d['especialidad']) ?></option>
              <?php endwhile; ?>
            </select>
          </div>
          <div class="col-12">
            <label class="form-label small fw-semibold">Habitación</label>
            <select name="id_habitacion" class="form-select" required>
              <option value="" disabled selected>Selecciona una habitación</option>
              <?php while ($h = $habitaciones->fetch_assoc()): ?>
                <option value="<?= $h['id_habitacion'] ?>">Hab. <?= htmlspecialchars($h['numero']) ?> — <?= htmlspecialchars($h['tipo']) ?></option>
              <?php endwhile; ?>
            </select>
          </div>
          <div class="col-md-6">
            <label class="form-label small fw-semibold">Fecha y hora</label>
            <input type="datetime-local" name="fecha_cita" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label class="form-label small fw-semibold">Estado</label>
            <select name="estado" class="form-select">
              <option value="Programada">Programada</option>
              <option value="Atendida">Atendida</option>
              <option value="Cancelada">Cancelada</option>
            </select>
          </div>
          <div class="col-12">
            <label class="form-label small fw-semibold">Motivo</label>
            <input type="text" name="motivo" class="form-control" maxlength="150">
          </div>
        </div>
        <div class="mt-4 d-flex gap-2">
          <button type="submit" class="btn btn-samy">Guardar cita</button>
          <a href="listar.php" class="btn btn-samy-outline">Cancelar</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
<?php $conn->close(); ?>
