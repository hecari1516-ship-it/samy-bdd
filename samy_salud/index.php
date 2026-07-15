<?php
require 'config.php';
requiereLogin();
$raiz = '';

$totalPacientes = $conn->query("SELECT COUNT(*) t FROM pacientes")->fetch_assoc()['t'];
$totalCitas     = $conn->query("SELECT COUNT(*) t FROM citas")->fetch_assoc()['t'];
$totalRecetas   = $conn->query("SELECT COUNT(*) t FROM recetas")->fetch_assoc()['t'];

if (esAdmin()) {
    $totalDoctores     = $conn->query("SELECT COUNT(*) t FROM doctores")->fetch_assoc()['t'];
    $totalHabitaciones = $conn->query("SELECT COUNT(*) t FROM habitaciones")->fetch_assoc()['t'];
}

// La bienvenida animada solo aparece una vez: justo después de iniciar sesión
$mostrarBienvenida = !empty($_SESSION['mostrar_bienvenida']);
unset($_SESSION['mostrar_bienvenida']);
$modoBienvenida  = esAdmin() ? 'Modo Administrador' : 'Panel médico';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>SaMy · Inicio</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <?php if ($mostrarBienvenida): ?>
  <div id="bienvenidaOverlay" class="bienvenida-overlay">
    <div class="bienvenida-tarjeta">
      <div class="bienvenida-saludo" id="bienvenidaSaludo">Hola</div>
      <div class="bienvenida-nombre"><?= htmlspecialchars($_SESSION['usuario_nombre']) ?></div>
      <div class="bienvenida-sub"><?= $modoBienvenida ?></div>
    </div>
  </div>
  <script>
    (function () {
      var overlay = document.getElementById('bienvenidaOverlay');
      var saludo = document.getElementById('bienvenidaSaludo');
      var hora = new Date().getHours();
      var texto = 'Buenas noches';
      if (hora >= 5 && hora < 12) texto = 'Buenos días';
      else if (hora >= 12 && hora < 19) texto = 'Buenas tardes';
      saludo.textContent = texto;

      function cerrar() {
        overlay.classList.add('bienvenida-salir');
        setTimeout(function () { overlay.remove(); }, 350);
      }
      overlay.addEventListener('click', cerrar);
      setTimeout(cerrar, 2000);
    })();
  </script>
  <?php endif; ?>

  <?php include 'includes/nav.php'; ?>

  <div class="page-wrap">
    <div class="eyebrow"><?= esAdmin() ? 'Panel de administración' : 'Panel médico' ?></div>
    <h1 class="page-title">Hola, <?= htmlspecialchars($_SESSION['usuario_nombre']) ?></h1>

    <?php if (isset($_GET['aviso']) && $_GET['aviso'] === 'sin_permiso'): ?>
      <div class="alert alert-warning py-2 small">Esa sección es exclusiva del Administrador.</div>
    <?php endif; ?>

    <div class="row g-3 mb-4">
      <div class="col-4 col-md-2">
        <div class="tarjeta text-center">
          <div class="fs-3 fw-bold"><?= $totalPacientes ?></div>
          <div class="small text-muted">Pacientes</div>
        </div>
      </div>
      <div class="col-4 col-md-2">
        <div class="tarjeta text-center">
          <div class="fs-3 fw-bold"><?= $totalCitas ?></div>
          <div class="small text-muted">Citas</div>
        </div>
      </div>
      <div class="col-4 col-md-2">
        <div class="tarjeta text-center">
          <div class="fs-3 fw-bold"><?= $totalRecetas ?></div>
          <div class="small text-muted">Recetas</div>
        </div>
      </div>
      <?php if (esAdmin()): ?>
      <div class="col-4 col-md-2">
        <div class="tarjeta text-center">
          <div class="fs-3 fw-bold"><?= $totalDoctores ?></div>
          <div class="small text-muted">Doctores</div>
        </div>
      </div>
      <div class="col-4 col-md-2">
        <div class="tarjeta text-center">
          <div class="fs-3 fw-bold"><?= $totalHabitaciones ?></div>
          <div class="small text-muted">Habitaciones</div>
        </div>
      </div>
      <?php endif; ?>
    </div>

    <div class="row g-3">
      <div class="col-md-4">
        <a href="pacientes/listar.php" class="text-decoration-none">
          <div class="tarjeta"><h5 class="mb-1">Pacientes</h5>
          <p class="small text-muted mb-0"><?= esAdmin() ? 'Registrar, buscar, modificar y eliminar pacientes.' : 'Consultar el listado de pacientes.' ?></p></div>
        </a>
      </div>
      <div class="col-md-4">
        <a href="citas/tablero.php" class="text-decoration-none">
          <div class="tarjeta"><h5 class="mb-1">Citas</h5>
          <p class="small text-muted mb-0">Agenda tipo tablero: arrastra una cita para cambiar su estado.</p></div>
        </a>
      </div>
      <div class="col-md-4">
        <a href="recetas/listar.php" class="text-decoration-none">
          <div class="tarjeta"><h5 class="mb-1">Recetas</h5>
          <p class="small text-muted mb-0">Generar e imprimir recetas médicas por cita.</p></div>
        </a>
      </div>

      <?php if (esAdmin()): ?>
      <div class="col-md-4">
        <a href="doctores/listar.php" class="text-decoration-none">
          <div class="tarjeta"><h5 class="mb-1">Doctores</h5>
          <p class="small text-muted mb-0">Gestionar el directorio médico.</p></div>
        </a>
      </div>
      <div class="col-md-4">
        <a href="habitaciones/listar.php" class="text-decoration-none">
          <div class="tarjeta"><h5 class="mb-1">Habitaciones</h5>
          <p class="small text-muted mb-0">Disponibilidad y estado de habitaciones.</p></div>
        </a>
      </div>
      <div class="col-md-4">
        <a href="consultas.php" class="text-decoration-none">
          <div class="tarjeta"><h5 class="mb-1">Reportes (JOIN)</h5>
          <p class="small text-muted mb-0">Consultas de múltiples tablas: citas, doctores y habitaciones.</p></div>
        </a>
      </div>
      <div class="col-md-4">
        <a href="crear_admin.php" class="text-decoration-none">
          <div class="tarjeta"><h5 class="mb-1">Usuarios</h5>
          <p class="small text-muted mb-0">Crear cuentas de Administrador o Médico.</p></div>
        </a>
      </div>
      <?php endif; ?>
    </div>
  </div>

</body>
</html>
<?php $conn->close(); ?>
