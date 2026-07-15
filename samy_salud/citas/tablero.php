<?php
require '../config.php';
requiereLogin();
$raiz = '../';

$sql = "SELECT c.id_cita, c.fecha_cita, c.motivo, c.estado,
               p.nombre AS p_nombre, p.apellido AS p_apellido,
               d.nombre AS d_nombre, d.apellido AS d_apellido
        FROM citas c
        INNER JOIN pacientes p ON c.id_paciente = p.id_paciente
        INNER JOIN doctores d ON c.id_doctor = d.id_doctor
        ORDER BY c.fecha_cita ASC";
$resultado = $conn->query($sql);

$columnas = ['Programada' => [], 'Atendida' => [], 'Cancelada' => []];
while ($c = $resultado->fetch_assoc()) {
    $columnas[$c['estado']][] = $c;
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
<body data-csrf="<?= htmlspecialchars(csrfToken()) ?>">
  <?php include '../includes/nav.php'; ?>

  <div class="page-wrap">
    <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-3">
      <div>
        <div class="eyebrow">Agenda</div>
        <h1 class="page-title mb-0">Citas</h1>
        <p class="text-muted small mt-1 mb-0">Arrastra una cita entre columnas para cambiar su estado.</p>
      </div>
      <a href="crear.php" class="btn btn-samy">+ Agendar cita</a>
    </div>

    <div class="tablero">
      <?php foreach ($columnas as $estado => $citas): ?>
        <div class="tablero-columna" data-estado="<?= $estado ?>">
          <h6><?= $estado ?> (<?= count($citas) ?>)</h6>
          <?php foreach ($citas as $c): ?>
            <div class="tarjeta-cita" draggable="true" data-id="<?= $c['id_cita'] ?>">
              <div class="paciente"><?= htmlspecialchars($c['p_nombre'].' '.$c['p_apellido']) ?></div>
              <div class="meta">Dr(a). <?= htmlspecialchars($c['d_nombre'].' '.$c['d_apellido']) ?></div>
              <div class="meta"><?= htmlspecialchars(date('d/m/Y H:i', strtotime($c['fecha_cita']))) ?></div>
              <?php if (esAdmin()): ?>
                <a href="editar.php?id=<?= $c['id_cita'] ?>" class="small">Editar</a>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <script>
    const csrfToken = document.body.dataset.csrf;
    let tarjetaArrastrada = null;

    document.querySelectorAll('.tarjeta-cita').forEach(tarjeta => {
      tarjeta.addEventListener('dragstart', () => {
        tarjetaArrastrada = tarjeta;
        tarjeta.classList.add('arrastrando');
      });
      tarjeta.addEventListener('dragend', () => {
        tarjeta.classList.remove('arrastrando');
      });
    });

    document.querySelectorAll('.tablero-columna').forEach(columna => {
      columna.addEventListener('dragover', (e) => {
        e.preventDefault();
        columna.classList.add('sobre-arrastre');
      });
      columna.addEventListener('dragleave', () => {
        columna.classList.remove('sobre-arrastre');
      });
      columna.addEventListener('drop', async (e) => {
        e.preventDefault();
        columna.classList.remove('sobre-arrastre');
        if (!tarjetaArrastrada) return;

        const idCita = tarjetaArrastrada.dataset.id;
        const nuevoEstado = columna.dataset.estado;
        columna.appendChild(tarjetaArrastrada);

        // Reinicia la animación de "aparición" al soltar la tarjeta
        tarjetaArrastrada.style.animation = 'none';
        void tarjetaArrastrada.offsetWidth; // fuerza el reflow
        tarjetaArrastrada.style.animation = '';

        try {
          const resp = await fetch('actualizar_estado.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `id_cita=${idCita}&estado=${encodeURIComponent(nuevoEstado)}&csrf_token=${encodeURIComponent(csrfToken)}`
          });
          if (!resp.ok) throw new Error('No se pudo actualizar');
        } catch (err) {
          alert('No se pudo guardar el cambio. Recarga la página e intenta de nuevo.');
          location.reload();
        }
      });
    });
  </script>
</body>
</html>
<?php $conn->close(); ?>
