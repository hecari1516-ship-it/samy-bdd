<?php
require '../config.php';
requiereAdmin();
$raiz = '../';
$resultado = $conn->query("SELECT * FROM doctores ORDER BY id_doctor DESC");
$total = $resultado->num_rows;
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Doctores · SaMy</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <?php include '../includes/nav.php'; ?>
  <div class="page-wrap">
    <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-3">
      <div><div class="eyebrow">Directorio médico</div><h1 class="page-title mb-0">Doctores</h1></div>
      <a href="crear.php" class="btn btn-samy">+ Registrar doctor</a>
    </div>
    <?php if (isset($_GET['msg'])): ?>
      <div class="alert alert-success py-2 small"><?= $_GET['msg']==='ok'?'Doctor guardado correctamente.':'Doctor eliminado.' ?></div>
    <?php endif; ?>
    <div class="tabla-envoltorio">
      <table class="table tabla-samy mb-0">
        <thead><tr><th>ID</th><th>Nombre</th><th>Especialidad</th><th>Teléfono</th><th>Cédula</th><th></th></tr></thead>
        <tbody>
        <?php if ($total===0): ?>
          <tr><td colspan="6" class="text-center text-muted py-4">No hay doctores registrados.</td></tr>
        <?php else: while($d=$resultado->fetch_assoc()): ?>
          <tr>
            <td>#<?= $d['id_doctor'] ?></td>
            <td><?= htmlspecialchars($d['nombre'].' '.$d['apellido']) ?></td>
            <td><span class="pill pill-azul"><?= htmlspecialchars($d['especialidad']?:'—') ?></span></td>
            <td><?= htmlspecialchars($d['telefono']) ?></td>
            <td><?= htmlspecialchars($d['cedula_prof']) ?></td>
            <td>
              <a class="mini-accion mini-editar" href="editar.php?id=<?= $d['id_doctor'] ?>">Editar</a>
              <form action="eliminar.php" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este doctor?');">
        <?= csrfCampo() ?>
                <input type="hidden" name="id_doctor" value="<?= $d['id_doctor'] ?>">
                <button class="mini-accion mini-eliminar">Eliminar</button>
              </form>
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
