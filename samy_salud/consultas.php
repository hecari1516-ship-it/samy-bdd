<?php
require 'config.php';
requiereAdmin();
$raiz = '';

// Consulta 1: citas con nombre del paciente y del médico
$consulta1 = "SELECT c.id_cita, p.nombre AS p_nombre, p.apellido AS p_apellido,
                     d.nombre AS d_nombre, d.apellido AS d_apellido, d.especialidad,
                     c.fecha_cita, c.estado
              FROM citas c
              INNER JOIN pacientes p ON c.id_paciente = p.id_paciente
              INNER JOIN doctores d ON c.id_doctor = d.id_doctor
              ORDER BY c.fecha_cita DESC";
$r1 = $conn->query($consulta1);

// Consulta 2: habitaciones ocupadas con el paciente asignado
$consulta2 = "SELECT h.numero, h.tipo, p.nombre AS p_nombre, p.apellido AS p_apellido, c.fecha_cita
              FROM habitaciones h
              INNER JOIN citas c ON c.id_habitacion = h.id_habitacion
              INNER JOIN pacientes p ON c.id_paciente = p.id_paciente
              WHERE h.estado = 'Ocupada'
              ORDER BY h.numero";
$r2 = $conn->query($consulta2);

// Consulta 3: todas las citas programadas
$consulta3 = "SELECT c.id_cita, p.nombre AS p_nombre, p.apellido AS p_apellido,
                     d.nombre AS d_nombre, d.apellido AS d_apellido, c.fecha_cita
              FROM citas c
              INNER JOIN pacientes p ON c.id_paciente = p.id_paciente
              INNER JOIN doctores d ON c.id_doctor = d.id_doctor
              WHERE c.estado = 'Programada'
              ORDER BY c.fecha_cita";
$r3 = $conn->query($consulta3);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Reportes (JOIN) · SaMy</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <?php include 'includes/nav.php'; ?>

  <div class="page-wrap">
    <div class="eyebrow">Consultas de múltiples tablas</div>
    <h1 class="page-title">Reportes (JOIN)</h1>

    <!-- Consulta 1 -->
    <h5 class="mb-2" style="color:var(--ios-text)">Consulta 1 · Citas con paciente y médico</h5>
    <div class="tabla-envoltorio mb-4">
      <table class="table tabla-samy mb-0">
        <thead><tr><th>ID</th><th>Paciente</th><th>Doctor</th><th>Especialidad</th><th>Fecha</th><th>Estado</th></tr></thead>
        <tbody>
        <?php if ($r1->num_rows === 0): ?>
          <tr><td colspan="6" class="text-center text-muted py-3">Sin resultados.</td></tr>
        <?php else: while ($f = $r1->fetch_assoc()): ?>
          <tr>
            <td>#<?= $f['id_cita'] ?></td>
            <td><?= htmlspecialchars($f['p_nombre'].' '.$f['p_apellido']) ?></td>
            <td>Dr(a). <?= htmlspecialchars($f['d_nombre'].' '.$f['d_apellido']) ?></td>
            <td><?= htmlspecialchars($f['especialidad']) ?></td>
            <td><?= htmlspecialchars(date('d/m/Y H:i', strtotime($f['fecha_cita']))) ?></td>
            <td><?= htmlspecialchars($f['estado']) ?></td>
          </tr>
        <?php endwhile; endif; ?>
        </tbody>
      </table>
    </div>

    <!-- Consulta 2 -->
    <h5 class="mb-2" style="color:var(--ios-text)">Consulta 2 · Habitaciones ocupadas con paciente asignado</h5>
    <div class="tabla-envoltorio mb-4">
      <table class="table tabla-samy mb-0">
        <thead><tr><th>Habitación</th><th>Tipo</th><th>Paciente</th><th>Fecha de cita</th></tr></thead>
        <tbody>
        <?php if ($r2->num_rows === 0): ?>
          <tr><td colspan="4" class="text-center text-muted py-3">No hay habitaciones ocupadas actualmente.</td></tr>
        <?php else: while ($f = $r2->fetch_assoc()): ?>
          <tr>
            <td>Hab. <?= htmlspecialchars($f['numero']) ?></td>
            <td><?= htmlspecialchars($f['tipo']) ?></td>
            <td><?= htmlspecialchars($f['p_nombre'].' '.$f['p_apellido']) ?></td>
            <td><?= htmlspecialchars(date('d/m/Y H:i', strtotime($f['fecha_cita']))) ?></td>
          </tr>
        <?php endwhile; endif; ?>
        </tbody>
      </table>
    </div>

    <!-- Consulta 3 -->
    <h5 class="mb-2" style="color:var(--ios-text)">Consulta 3 · Citas programadas</h5>
    <div class="tabla-envoltorio mb-4">
      <table class="table tabla-samy mb-0">
        <thead><tr><th>ID</th><th>Paciente</th><th>Doctor</th><th>Fecha</th></tr></thead>
        <tbody>
        <?php if ($r3->num_rows === 0): ?>
          <tr><td colspan="4" class="text-center text-muted py-3">No hay citas programadas.</td></tr>
        <?php else: while ($f = $r3->fetch_assoc()): ?>
          <tr>
            <td>#<?= $f['id_cita'] ?></td>
            <td><?= htmlspecialchars($f['p_nombre'].' '.$f['p_apellido']) ?></td>
            <td>Dr(a). <?= htmlspecialchars($f['d_nombre'].' '.$f['d_apellido']) ?></td>
            <td><?= htmlspecialchars(date('d/m/Y H:i', strtotime($f['fecha_cita']))) ?></td>
          </tr>
        <?php endwhile; endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
<?php $conn->close(); ?>
