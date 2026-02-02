<!-- DATABASE -->

<?php
    // database.php
    require_once "config.php"; 

    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    try {
        // Definimos el charset aquí, lo cual es más estándar
        $dsn = "mysql:host=" . HOST . ";dbname=" . DBNAME . ";charset=utf8";

        $pdo = new PDO($dsn, USERNAME, PASSWORD, $options);

    } catch (PDOException $e) {
        die("Error de conexión: " . $e->getMessage());
    }
?>