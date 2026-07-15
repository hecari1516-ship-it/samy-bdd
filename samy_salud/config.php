<?php
// ============================================
// Conexión y seguridad — SaMy
// ============================================

// Cookies de sesión reforzadas (antes de iniciar sesión)
session_set_cookie_params([
    'httponly' => true,
    'samesite' => 'Lax',
]);
session_start();

// Regenerar el ID de sesión periódicamente para mitigar fijación de sesión
if (!isset($_SESSION['iniciada_en'])) {
    $_SESSION['iniciada_en'] = time();
} elseif (time() - $_SESSION['iniciada_en'] > 900) {
    session_regenerate_id(true);
    $_SESSION['iniciada_en'] = time();
}

$host = 'localhost';
$usuario_db = 'root';
$password_db = '';
$basedatos = 'hospital_db';

$conn = new mysqli($host, $usuario_db, $password_db, $basedatos);

if ($conn->connect_error) {
    die('Error de conexión: ' . $conn->connect_error);
}
$conn->set_charset('utf8mb4');

// ---------- Autenticación y roles ----------

function requiereLogin() {
    if (!isset($_SESSION['usuario_id'])) {
        header('Location: ' . rutaLogin());
        exit;
    }
}

function rutaLogin() {
    $enSubcarpeta = preg_match('#/(pacientes|doctores|habitaciones|citas|recetas)/#', $_SERVER['PHP_SELF']);
    return $enSubcarpeta ? '../login.php' : 'login.php';
}

function rutaIndex() {
    $enSubcarpeta = preg_match('#/(pacientes|doctores|habitaciones|citas|recetas)/#', $_SERVER['PHP_SELF']);
    return $enSubcarpeta ? '../index.php' : 'index.php';
}

// Solo Administrador puede pasar; Médico es redirigido al inicio
function requiereAdmin() {
    requiereLogin();
    if ($_SESSION['usuario_rol'] !== 'Administrador') {
        header('Location: ' . rutaIndex() . '?aviso=sin_permiso');
        exit;
    }
}

function esAdmin() {
    return isset($_SESSION['usuario_rol']) && $_SESSION['usuario_rol'] === 'Administrador';
}

// ---------- Protección CSRF ----------

function csrfToken() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function csrfCampo() {
    return '<input type="hidden" name="csrf_token" value="' . htmlspecialchars(csrfToken()) . '">';
}

function verificarCsrf() {
    $enviado = $_POST['csrf_token'] ?? '';
    if (!hash_equals($_SESSION['csrf_token'] ?? '', $enviado)) {
        die('Solicitud inválida o expirada. Vuelve a intentarlo desde el formulario.');
    }
}
?>
