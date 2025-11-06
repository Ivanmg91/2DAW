<?php
$host = '127.0.0.1';   // Dirección del servidor
$db   = 'kanban_board'; // Nombre de la base de datos
$user = 'root';         // Usuario root
$pass = '';             // No hay contraseña
$charset = 'utf8mb4';   // Codificación de caracteres

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// Opciones para PDO
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    // Conexión a la base de datos
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // Mostrar error en caso de falla
    http_response_code(500);
    echo json_encode([
        'error' => 'Error de conexión a la base de datos',
        'message' => $e->getMessage() // Esto nos da más detalles del error
    ]);
    exit;
}
?>
