<?php

    $correo = $_POST['correo'] ?? null;
    $confirmacion = $_POST['confirmacion'] ?? null;
    $publicidad = isset($_POST['publicidad']) ? "Si" : "No";

    $correo_anterior = $_COOKIE['correo'] ?? "No hay datos anteriores";
    $publicidad_anterior = $_COOKIE['publicidad'] ?? "No hay datos anteriores";

    if ($correo !== $confirmacion) {
        echo "Ambos correos no coinciden.<br><br>";
    } else {

        setcookie("correo", $correo, time() + 3600);
        setcookie("publicidad", $publicidad, time() + 3600);

        echo "Datos de la ejecución actual";
        echo "Correo: $correo <br>";
        echo "Acepta publicidad: $publicidad <br><br>";
    }

    echo "Datos de la ejecución anterior (Cookie)";
    echo "Correo anterior: $correo_anterior <br>";
    echo "Aceptaba publicidad: $publicidad_anterior <br><br>";

    
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejer10</title>
</head>
<body>
    <p><a href="index.html">Volver</a></p>
</body>
</html>
