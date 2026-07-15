<?php $rolActual = $_SESSION['usuario_rol'] ?? ''; ?>
<nav class="navbar navbar-expand-lg navbar-samy">
  <div class="container-fluid px-4">

    <!-- Fila 1: logo perfectamente centrado -->
    <div class="nav-fila-logo">
      <a class="navbar-brand navbar-brand-centrado" href="<?= $raiz ?>index.php">SaMy</a>

      <div class="nav-esquina">
        <span class="badge-rol"><?= htmlspecialchars($rolActual) ?></span>
        <a class="nav-link nav-salir" href="<?= $raiz ?>logout.php">Salir</a>
      </div>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>

    <!-- Fila 2: enlaces centrados -->
    <div class="collapse navbar-collapse justify-content-center" id="navMenu">
      <ul class="navbar-nav nav-links-centradas align-items-lg-center">
        <li class="nav-item"><a class="nav-link" href="<?= $raiz ?>index.php">Inicio</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= $raiz ?>pacientes/listar.php">Pacientes</a></li>
        <?php if ($rolActual === 'Administrador'): ?>
          <li class="nav-item"><a class="nav-link" href="<?= $raiz ?>doctores/listar.php">Doctores</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= $raiz ?>habitaciones/listar.php">Habitaciones</a></li>
        <?php endif; ?>
        <li class="nav-item"><a class="nav-link" href="<?= $raiz ?>citas/tablero.php">Citas</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= $raiz ?>recetas/listar.php">Recetas</a></li>
        <?php if ($rolActual === 'Administrador'): ?>
          <li class="nav-item"><a class="nav-link" href="<?= $raiz ?>consultas.php">Reportes</a></li>
        <?php endif; ?>
        <li class="nav-item d-lg-none mt-2"><span class="badge-rol"><?= htmlspecialchars($rolActual) ?></span></li>
        <li class="nav-item d-lg-none"><a class="nav-link nav-salir" href="<?= $raiz ?>logout.php">Salir</a></li>
      </ul>
    </div>

  </div>
</nav>
