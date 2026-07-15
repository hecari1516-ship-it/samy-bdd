<?php
require 'config.php';
requiereLogin();

$nombres = ['Ana','Luis','María','Carlos','Sofía','Jorge','Valentina','Diego','Camila','Andrés',
            'Isabella','Miguel','Renata','Fernando','Lucía','Ricardo','Paula','Emilio','Daniela','Alejandro',
            'Regina','Sebastián','Ximena','Emiliano','Fernanda'];
$apellidos = ['García','Martínez','López','Hernández','Ramírez','Torres','Flores','Sánchez','Rivera','Díaz',
              'Gómez','Cruz','Ortiz','Vargas','Castro','Mendoza','Guerrero','Rojas','Morales','Reyes'];
$sexos = ['M','F','Otro'];
$sangres = ['O+','O-','A+','A-','B+','B-','AB+','AB-'];
$especialidades = ['Cardiología','Pediatría','Traumatología','Ginecología','Medicina General','Dermatología','Neurología','Oncología','Urología','Psiquiatría'];
$tiposHab = ['General','Privada','Terapia Intensiva','Urgencias'];

$mensajes = [];

// 250 pacientes
$stmt = $conn->prepare("INSERT INTO pacientes (nombre, apellido, fecha_nacimiento, sexo, telefono, direccion, tipo_sangre) VALUES (?,?,?,?,?,?,?)");
for ($i = 0; $i < 250; $i++) {
    $nombre = $nombres[array_rand($nombres)];
    $apellido = $apellidos[array_rand($apellidos)];
    $nacimiento = sprintf('%04d-%02d-%02d', rand(1950, 2020), rand(1,12), rand(1,28));
    $sexo = $sexos[array_rand($sexos)];
    $telefono = '555' . rand(1000000, 9999999);
    $direccion = 'Calle ' . rand(1,50) . ' #' . rand(1,200);
    $sangre = $sangres[array_rand($sangres)];
    $stmt->bind_param("sssssss", $nombre, $apellido, $nacimiento, $sexo, $telefono, $direccion, $sangre);
    $stmt->execute();
}
$mensajes[] = "250 pacientes insertados.";

// 10 doctores
$stmt = $conn->prepare("INSERT INTO doctores (nombre, apellido, especialidad, telefono, cedula_prof) VALUES (?,?,?,?,?)");
for ($i = 0; $i < 10; $i++) {
    $nombre = $nombres[array_rand($nombres)];
    $apellido = $apellidos[array_rand($apellidos)];
    $especialidad = $especialidades[$i % count($especialidades)];
    $telefono = '555' . rand(1000000, 9999999);
    $cedula = (string) rand(1000000, 9999999);
    $stmt->bind_param("sssss", $nombre, $apellido, $especialidad, $telefono, $cedula);
    $stmt->execute();
}
$mensajes[] = "10 doctores insertados.";

// 20 habitaciones
$stmt = $conn->prepare("INSERT INTO habitaciones (numero, tipo, estado) VALUES (?,?,?)");
for ($i = 1; $i <= 20; $i++) {
    $numero = (string) (100 + $i);
    $tipo = $tiposHab[$i % count($tiposHab)];
    $estado = ($i % 3 === 0) ? 'Ocupada' : 'Disponible';
    $stmt->bind_param("sss", $numero, $tipo, $estado);
    $stmt->execute();
}
$mensajes[] = "20 habitaciones insertadas.";

// IDs disponibles para relacionar citas
$idsPacientes = [];
$res = $conn->query("SELECT id_paciente FROM pacientes");
while ($f = $res->fetch_assoc()) $idsPacientes[] = $f['id_paciente'];

$idsDoctores = [];
$res = $conn->query("SELECT id_doctor FROM doctores");
while ($f = $res->fetch_assoc()) $idsDoctores[] = $f['id_doctor'];

$idsHabitaciones = [];
$res = $conn->query("SELECT id_habitacion FROM habitaciones");
while ($f = $res->fetch_assoc()) $idsHabitaciones[] = $f['id_habitacion'];

$motivos = ['Consulta general','Dolor de cabeza','Revisión de rutina','Dolor abdominal','Control de presión','Seguimiento','Fiebre','Chequeo anual'];
$estadosCita = ['Programada','Atendida','Cancelada'];

// 25 citas
$idsCitas = [];
$stmt = $conn->prepare("INSERT INTO citas (id_paciente, id_doctor, id_habitacion, fecha_cita, motivo, estado) VALUES (?,?,?,?,?,?)");
for ($i = 0; $i < 25; $i++) {
    $idp = $idsPacientes[array_rand($idsPacientes)];
    $idd = $idsDoctores[array_rand($idsDoctores)];
    $idh = $idsHabitaciones[array_rand($idsHabitaciones)];
    $fecha = sprintf('2026-%02d-%02d %02d:%02d:00', rand(1,12), rand(1,28), rand(8,18), rand(0,59));
    $motivo = $motivos[array_rand($motivos)];
    $estado = $estadosCita[array_rand($estadosCita)];
    $stmt->bind_param("iiisss", $idp, $idd, $idh, $fecha, $motivo, $estado);
    $stmt->execute();
    $idsCitas[] = $stmt->insert_id;
}
$mensajes[] = "25 citas insertadas.";

// 25 recetas
$medicamentos = ['Paracetamol','Ibuprofeno','Amoxicilina','Loratadina','Omeprazol','Metformina','Losartán','Naproxeno'];
$stmt = $conn->prepare("INSERT INTO recetas (id_cita, medicamento, dosis, indicaciones) VALUES (?,?,?,?)");
foreach ($idsCitas as $idc) {
    $med = $medicamentos[array_rand($medicamentos)];
    $dosis = rand(1,2) . ' tableta(s) cada ' . [8,12,24][array_rand([8,12,24])] . ' horas';
    $indic = 'Tomar con alimentos. Acudir a revisión en 7 días si persisten los síntomas.';
    $stmt->bind_param("isss", $idc, $med, $dosis, $indic);
    $stmt->execute();
}
$mensajes[] = "25 recetas insertadas.";

$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Datos de prueba generados</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/style.css"></head>
<body>
<div class="page-wrap" style="max-width:500px">
  <h1 class="page-title">Datos de prueba generados</h1>
  <div class="tarjeta">
    <ul class="mb-3">
      <?php foreach ($mensajes as $m): ?><li><?= $m ?></li><?php endforeach; ?>
    </ul>
    <a href="index.php" class="btn btn-samy">Ir al inicio</a>
  </div>
  <p class="text-muted small mt-3">⚠️ Corre este script una sola vez. Si lo ejecutas de nuevo, duplicará los registros.</p>
</div>
</body>
</html>
