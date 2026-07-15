<?php
require '../config.php';
requiereLogin();
$raiz = '../';

$id = (int) ($_GET['id'] ?? 0);
$sql = "SELECT r.*, c.fecha_cita, c.motivo,
               p.nombre AS p_nombre, p.apellido AS p_apellido, p.fecha_nacimiento, p.tipo_sangre,
               d.nombre AS d_nombre, d.apellido AS d_apellido, d.especialidad, d.cedula_prof
        FROM recetas r
        INNER JOIN citas c ON r.id_cita = c.id_cita
        INNER JOIN pacientes p ON c.id_paciente = p.id_paciente
        INNER JOIN doctores d ON c.id_doctor = d.id_doctor
        WHERE r.id_receta = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
if ($resultado->num_rows === 0) { header('Location: listar.php'); exit; }
$r = $resultado->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Receta #<?= $r['id_receta'] ?> · SaMy</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <div class="no-imprimir"><?php include '../includes/nav.php'; ?></div>

  <div class="page-wrap">
    <div class="no-imprimir d-flex justify-content-between align-items-center mb-3">
      <div><div class="eyebrow">Receta médica</div><h1 class="page-title mb-0">Receta #<?= $r['id_receta'] ?></h1></div>
      <div class="d-flex gap-2">
        <button onclick="window.print()" class="btn btn-samy">🖨 Imprimir receta</button>
        <a href="listar.php" class="btn btn-samy-outline">Volver</a>
      </div>
    </div>

    <div class="receta-hoja">
      <div class="d-flex justify-content-between align-items-start border-bottom pb-3 mb-3">
        <div>
          <h2 class="h5 mb-0">Hospital SaMy</h2>
          <div class="text-muted small">Receta médica oficial</div>
        </div>
        <div class="text-end small text-muted">
          Folio #<?= str_pad($r['id_receta'], 5, '0', STR_PAD_LEFT) ?><br>
          <?= htmlspecialchars(date('d/m/Y', strtotime($r['fecha_cita']))) ?>
        </div>
      </div>

      <div class="row mb-3">
        <div class="col-6">
          <div class="small text-muted mb-1">Paciente</div>
          <div class="fw-semibold"><?= htmlspecialchars($r['p_nombre'].' '.$r['p_apellido']) ?></div>
          <div class="small text-muted">Nacimiento: <?= htmlspecialchars($r['fecha_nacimiento']) ?> · Sangre: <?= htmlspecialchars($r['tipo_sangre'] ?: '—') ?></div>
        </div>
        <div class="col-6">
          <div class="small text-muted mb-1">Médico</div>
          <div class="fw-semibold">Dr(a). <?= htmlspecialchars($r['d_nombre'].' '.$r['d_apellido']) ?></div>
          <div class="small text-muted"><?= htmlspecialchars($r['especialidad']) ?> · Céd. <?= htmlspecialchars($r['cedula_prof']) ?></div>
        </div>
      </div>

      <div class="mb-3">
        <div class="small text-muted mb-1">Motivo de la consulta</div>
        <div><?= htmlspecialchars($r['motivo'] ?: '—') ?></div>
      </div>

      <hr>

      <div class="mb-2">
        <div class="small text-muted mb-1">Rx — Medicamento</div>
        <div class="fs-5 fw-semibold"><?= htmlspecialchars($r['medicamento']) ?></div>
      </div>
      <div class="mb-2">
        <div class="small text-muted mb-1">Dosis</div>
        <div><?= htmlspecialchars($r['dosis'] ?: '—') ?></div>
      </div>
      <div class="mb-4">
        <div class="small text-muted mb-1">Indicaciones</div>
        <div><?= nl2br(htmlspecialchars($r['indicaciones'] ?: '—')) ?></div>
      </div>

      <div class="text-center small text-muted mt-5 pt-4 border-top">
        Firma del médico tratante
      </div>
    </div>
  </div>
</body>
</html>
<?php $conn->close(); ?>
