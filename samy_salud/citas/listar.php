<?php
require '../config.php';
requiereLogin();
$raiz = '../';

$sql = "SELECT c.id_cita, c.fecha_cita, c.motivo, c.estado,
               p.nombre AS p_nombre, p.apellido AS p_apellido,
               d.nombre AS d_nombre, d.apellido AS d_apellido,
               h.numero AS hab_numero
        FROM citas c
        INNER JOIN pacientes p ON c.id_paciente = p.id_paciente
        INNER JOIN doctores d ON c.id_doctor = d.id_doctor
        INNER JOIN habitaciones h ON c.id_habitacion = h.id_habitacion
        ORDER BY c.fecha_cita DESC";
$resultado = $conn->query($sql);
$total = $resultado->num_rows;

function pillCita($estado) {
    $map = ['Programada'=>'pill-azul', 'Atendida'=>'pill-verde', 'Cancelada'=>'pill-rojo'];
    return $map[$estado] ?? 'pill-azul';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Citas · SaMy</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <?php include '../includes/nav.php'; ?>
  <div class="page-wrap">
    <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-3">
      <div><div class="eyebrow">Agenda · vista de lista</div><h1 class="page-title mb-0">Citas</h1></div>
      <div class="d-flex gap-2">
        <a href="tablero.php" class="btn btn-samy-outline">Ver tablero</a>
        <a href="crear.php" class="btn btn-samy">+ Agendar cita</a>
      </div>
    </div>
    <?php if (isset($_GET['msg'])): ?>
      <div class="alert alert-success py-2 small"><?= $_GET['msg']==='ok'?'Cita guardada correctamente.':'Cita eliminada.' ?></div>
    <?php endif; ?>
    <div class="tabla-envoltorio">
      <table class="table tabla-samy mb-0">
        <thead><tr><th>ID</th><th>Paciente</th><th>Doctor</th><th>Habitación</th><th>Fecha</th><th>Estado</th><th></th></tr></thead>
        <tbody>
        <?php if ($total===0): ?>
          <tr><td colspan="7" class="text-center text-muted py-4">No hay citas registradas.</td></tr>
        <?php else: while($c=$resultado->fetch_assoc()): ?>
          <tr>
            <td>#<?= $c['id_cita'] ?></td>
            <td><?= htmlspecialchars($c['p_nombre'].' '.$c['p_apellido']) ?></td>
            <td>Dr(a). <?= htmlspecialchars($c['d_nombre'].' '.$c['d_apellido']) ?></td>
            <td><?= htmlspecialchars($c['hab_numero']) ?></td>
            <td><?= htmlspecialchars(date('d/m/Y H:i', strtotime($c['fecha_cita']))) ?></td>
            <td><span class="pill <?= pillCita($c['estado']) ?>"><?= htmlspecialchars($c['estado']) ?></span></td>
            <td>
              <?php if (esAdmin()): ?>
              <a class="mini-accion mini-editar" href="editar.php?id=<?= $c['id_cita'] ?>">Editar</a>
              <form action="eliminar.php" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar esta cita?');">
        <?= csrfCampo() ?>
                <input type="hidden" name="id_cita" value="<?= $c['id_cita'] ?>">
                <button class="mini-accion mini-eliminar">Eliminar</button>
              </form>
              <?php else: ?>
                <span class="text-muted small">—</span>
              <?php endif; ?>
            </td>
          </tr>
        <?php endwhile; endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
<?php $conn->close(); ?>
