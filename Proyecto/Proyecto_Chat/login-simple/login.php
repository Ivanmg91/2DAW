<?php
// Configuración de seguridad recomendada por el documento
ini_set('session.cookie_httponly', 1); // Protege contra XSS
ini_set('session.use_strict_mode', 1); // Evita fijación de sesiones
ini_set('session.cookie_samesite', 'Strict'); // Protege contra CSRF

session_start();
header('Content-Type: application/json');

// Conexión a BD
$host = '127.0.0.1';
$db   = 'login';
$user = 'root';
$pass = ''; // Pon tu contraseña de root si tienes una

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error BD']);
    exit;
}

// Leer el JSON que envía app.js
$input = file_get_contents('php://input');
$data = json_decode($input, true);
$user_input = $data['user'] ?? '';
$password_input = $data['password'] ?? '';

// Verificar usuario
$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE user = ?");
$stmt->execute([$user_input]);
$usuario = $stmt->fetch();

// Verificar hash
if ($usuario && password_verify($password_input, $usuario['password'])) {
    $_SESSION['user'] = $user_input; // ¡Aquí nace la sesión!
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Usuario o contraseña incorrectos']);
}
?>