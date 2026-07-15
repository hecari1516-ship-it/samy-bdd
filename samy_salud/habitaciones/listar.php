<?php
require '../config.php';
requiereAdmin();
$raiz = '../';
$resultado = $conn->query("SELECT * FROM habitaciones ORDER BY id_habitacion DESC");
$total = $resultado->num_rows;
function pillEstado($estado) {
    $map = ['Disponible'=>'pill-verde', 'Ocupada'=>'pill-rojo', 'Mantenimiento'=>'pill-azul'];
    return $map[$estado] ?? 'pill-azul';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Habitaciones · SaMy</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <?php include '../includes/nav.php'; ?>
  <div class="page-wrap">
    <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-3">
      <div><div class="eyebrow">Infraestructura</div><h1 class="page-title mb-0">Habitaciones</h1></div>
      <a href="crear.php" class="btn btn-samy">+ Registrar habitación</a>
    </div>
    <?php if (isset($_GET['msg'])): ?>
      <div class="alert alert-success py-2 small"><?= $_GET['msg']==='ok'?'Habitación guardada correctamente.':'Habitación eliminada.' ?></div>
    <?php endif; ?>
    <div class="tabla-envoltorio">
      <table class="table tabla-samy mb-0">
        <thead><tr><th>ID</th><th>Número</th><th>Tipo</th><th>Estado</th><th></th></tr></thead>
        <tbody>
        <?php if ($total===0): ?>
          <tr><td colspan="5" class="text-center text-muted py-4">No hay habitaciones registradas.</td></tr>
        <?php else: while($h=$resultado->fetch_assoc()): ?>
          <tr>
            <td>#<?= $h['id_habitacion'] ?></td>
            <td><?= htmlspecialchars($h['numero']) ?></td>
            <td><?= htmlspecialchars($h['tipo']) ?></td>
            <td><span class="pill <?= pillEstado($h['estado']) ?>"><?= htmlspecialchars($h['estado']) ?></span></td>
            <td>
              <a class="mini-accion mini-editar" href="editar.php?id=<?= $h['id_habitacion'] ?>">Editar</a>
              <form action="eliminar.php" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar esta habitación?');">
        <?= csrfCampo() ?>
                <input type="hidden" name="id_habitacion" value="<?= $h['id_habitacion'] ?>">
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
