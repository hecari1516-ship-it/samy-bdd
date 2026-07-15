<?php
require '../config.php';
requiereAdmin();
$raiz = '../';

$id = (int) ($_GET['id'] ?? 0);
$stmt = $conn->prepare("SELECT * FROM citas WHERE id_cita = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
if ($resultado->num_rows === 0) { header('Location: listar.php'); exit; }
$c = $resultado->fetch_assoc();

$pacientes = $conn->query("SELECT id_paciente, nombre, apellido FROM pacientes ORDER BY nombre");
$doctores = $conn->query("SELECT id_doctor, nombre, apellido, especialidad FROM doctores ORDER BY nombre");
$habitaciones = $conn->query("SELECT id_habitacion, numero, tipo FROM habitaciones ORDER BY numero");
$fechaValor = str_replace(' ', 'T', substr($c['fecha_cita'], 0, 16));
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar cita · SaMy</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <?php include '../includes/nav.php'; ?>
  <div class="page-wrap" style="max-width:650px">
    <div class="eyebrow">Editar registro #<?= $c['id_cita'] ?></div>
    <h1 class="page-title">Modificar cita</h1>
    <div class="tarjeta">
      <form action="actualizar.php" method="POST">
        <?= csrfCampo() ?>
        <input type="hidden" name="id_cita" value="<?= $c['id_cita'] ?>">
        <div class="row g-3">
          <div class="col-12">
            <label class="form-label small fw-semibold">Paciente</label>
            <select name="id_paciente" class="form-select" required>
              <?php while ($p = $pacientes->fetch_assoc()): ?>
                <option value="<?= $p['id_paciente'] ?>" <?= $p['id_paciente']==$c['id_paciente']?'selected':'' ?>><?= htmlspecialchars($p['nombre'].' '.$p['apellido']) ?></option>
              <?php endwhile; ?>
            </select>
          </div>
          <div class="col-12">
            <label class="form-label small fw-semibold">Doctor</label>
            <select name="id_doctor" class="form-select" required>
              <?php while ($d = $doctores->fetch_assoc()): ?>
                <option value="<?= $d['id_doctor'] ?>" <?= $d['id_doctor']==$c['id_doctor']?'selected':'' ?>>Dr(a). <?= htmlspecialchars($d['nombre'].' '.$d['apellido']) ?> — <?= htmlspecialchars($d['especialidad']) ?></option>
              <?php endwhile; ?>
            </select>
          </div>
          <div class="col-12">
            <label class="form-label small fw-semibold">Habitación</label>
            <select name="id_habitacion" class="form-select" required>
              <?php while ($h = $habitaciones->fetch_assoc()): ?>
                <option value="<?= $h['id_habitacion'] ?>" <?= $h['id_habitacion']==$c['id_habitacion']?'selected':'' ?>>Hab. <?= htmlspecialchars($h['numero']) ?> — <?= htmlspecialchars($h['tipo']) ?></option>
              <?php endwhile; ?>
            </select>
          </div>
          <div class="col-md-6">
            <label class="form-label small fw-semibold">Fecha y hora</label>
            <input type="datetime-local" name="fecha_cita" class="form-control" value="<?= $fechaValor ?>" required>
          </div>
          <div class="col-md-6">
            <label class="form-label small fw-semibold">Estado</label>
            <select name="estado" class="form-select">
              <?php foreach (['Programada','Atendida','Cancelada'] as $e): ?>
                <option value="<?= $e ?>" <?= $c['estado']===$e?'selected':'' ?>><?= $e ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-12">
            <label class="form-label small fw-semibold">Motivo</label>
            <input type="text" name="motivo" class="form-control" value="<?= htmlspecialchars($c['motivo']) ?>" maxlength="150">
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
