<?php
require '../config.php';
requiereLogin();
$raiz = '../';

$sql = "SELECT r.id_receta, r.medicamento, r.dosis, c.fecha_cita,
               p.nombre AS p_nombre, p.apellido AS p_apellido,
               d.nombre AS d_nombre, d.apellido AS d_apellido
        FROM recetas r
        INNER JOIN citas c ON r.id_cita = c.id_cita
        INNER JOIN pacientes p ON c.id_paciente = p.id_paciente
        INNER JOIN doctores d ON c.id_doctor = d.id_doctor
        ORDER BY r.id_receta DESC";
$resultado = $conn->query($sql);
$total = $resultado->num_rows;
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Recetas · SaMy</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <?php include '../includes/nav.php'; ?>
  <div class="page-wrap">
    <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-3">
      <div><div class="eyebrow">Recetas médicas</div><h1 class="page-title mb-0">Recetas</h1></div>
      <a href="crear.php" class="btn btn-samy">+ Generar receta</a>
    </div>
    <div class="tabla-envoltorio">
      <table class="table tabla-samy mb-0">
        <thead><tr><th>ID</th><th>Paciente</th><th>Doctor</th><th>Fecha cita</th><th>Medicamento</th><th></th></tr></thead>
        <tbody>
        <?php if ($total===0): ?>
          <tr><td colspan="6" class="text-center text-muted py-4">No hay recetas generadas.</td></tr>
        <?php else: while($r=$resultado->fetch_assoc()): ?>
          <tr>
            <td>#<?= $r['id_receta'] ?></td>
            <td><?= htmlspecialchars($r['p_nombre'].' '.$r['p_apellido']) ?></td>
            <td>Dr(a). <?= htmlspecialchars($r['d_nombre'].' '.$r['d_apellido']) ?></td>
            <td><?= htmlspecialchars(date('d/m/Y', strtotime($r['fecha_cita']))) ?></td>
            <td><span class="pill pill-azul"><?= htmlspecialchars($r['medicamento']) ?></span></td>
            <td><a class="mini-accion mini-editar" href="ver.php?id=<?= $r['id_receta'] ?>">Ver / Imprimir</a></td>
          </tr>
        <?php endwhile; endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
<?php $conn->close(); ?>
