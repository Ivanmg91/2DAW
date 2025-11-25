<?php
    session_start();

    $zona_actual = $_POST['zona'] ?? 'Europe/Madrid';

    $zona_anterior = $_SESSION['zona'] ?? 'No hay datos';
    $hora_anterior = $_SESSION['hora'] ?? 'No hay datos';

    date_default_timezone_set($zona_actual);
    $hora_actual = date("Y-m-d H:i:s");

    $_SESSION['zona'] = $zona_actual;
    $_SESSION['hora'] = $hora_actual;

    echo "Zona horaria actual: $zona_actual<br>";
    echo "Hora actual: $hora_actual<br><br>";

    echo "Zona horaria anterior: $zona_anterior<br>";
    echo "Hora anterior: $hora_anterior<br><br>";

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Zona Horaria</title>
</head>
<body>

<a href="index.html">Volver</a>

</body>
</html>
