<?php
require '../config.php';
requiereLogin();
$raiz = '../';

$buscar = trim($_GET['buscar'] ?? '');

if ($buscar !== '') {
    $stmt = $conn->prepare("SELECT * FROM pacientes WHERE nombre LIKE ? OR apellido LIKE ? ORDER BY id_paciente DESC");
    $like = "%$buscar%";
    $stmt->bind_param("ss", $like, $like);
    $stmt->execute();
    $resultado = $stmt->get_result();
} else {
    $resultado = $conn->query("SELECT * FROM pacientes ORDER BY id_paciente DESC");
}
$total = $resultado->num_rows;
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Pacientes · SaMy</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <?php include '../includes/nav.php'; ?>

  <div class="page-wrap">
    <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-3">
      <div>
        <div class="eyebrow">Gestión</div>
        <h1 class="page-title mb-0">Pacientes</h1>
      </div>
      <?php if (esAdmin()): ?><a href="crear.php" class="btn btn-samy">+ Registrar paciente</a><?php endif; ?>
    </div>

    <?php if (isset($_GET['msg'])): ?>
      <div class="alert alert-success py-2 small"><?= $_GET['msg'] === 'ok' ? 'Paciente guardado correctamente.' : 'Paciente eliminado.' ?></div>
    <?php endif; ?>

    <form class="mb-3" method="GET">
      <div class="input-group" style="max-width:320px">
        <input type="text" name="buscar" class="form-control" placeholder="Buscar por nombre o apellido" value="<?= htmlspecialchars($buscar) ?>">
        <button class="btn btn-samy-outline">Buscar</button>
      </div>
    </form>

    <div class="tabla-envoltorio">
      <table class="table tabla-samy mb-0">
        <thead>
          <tr><th>ID</th><th>Nombre</th><th>Nacimiento</th><th>Sexo</th><th>Teléfono</th><th>Tipo sangre</th><th></th></tr>
        </thead>
        <tbody>
          <?php if ($total === 0): ?>
            <tr><td colspan="7" class="text-center text-muted py-4">No hay pacientes registrados.</td></tr>
          <?php else: while ($p = $resultado->fetch_assoc()): ?>
            <tr>
              <td>#<?= $p['id_paciente'] ?></td>
              <td><?= htmlspecialchars($p['nombre'].' '.$p['apellido']) ?></td>
              <td><?= htmlspecialchars($p['fecha_nacimiento']) ?></td>
              <td><?= htmlspecialchars($p['sexo']) ?></td>
              <td><?= htmlspecialchars($p['telefono']) ?></td>
              <td><span class="pill pill-azul"><?= htmlspecialchars($p['tipo_sangre'] ?: '—') ?></span></td>
              <td>
                <?php if (esAdmin()): ?>
                <a class="mini-accion mini-editar" href="editar.php?id=<?= $p['id_paciente'] ?>">Editar</a>
                <form action="eliminar.php" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este paciente?');">
        <?= csrfCampo() ?>
                  <input type="hidden" name="id_paciente" value="<?= $p['id_paciente'] ?>">
                  <button class="mini-accion mini-eliminar">Eliminar</button>
                </form>
                <?php else: ?>
                  <span class="text-muted small">Solo lectura</span>
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
