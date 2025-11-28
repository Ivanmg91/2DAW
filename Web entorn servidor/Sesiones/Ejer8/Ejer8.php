<?php
    session_start();

    $zona_actual = $_POST['zona'] ?? 'Europe/Madrid';

    $zona_anterior = $_SESSION['zona'] ?? 'No hay datos';
    $hora_anterior = $_SESSION['hora'] ?? 'No hay datos';

    date_default_timezone_set($zona_actual);
    $hora_actual = date("Y-m-d H:i:s");

    $_SESSION['zona'] = $zona_actual;
    $_SESSION['hora'] = $hora_actual;

?>

<!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Zona Horaria</title>
    </head>
    <body>

        <p>
            Zona horaria actual: <?php echo $zona_actual; ?>
            Hora actual: <?php echo $hora_actual; ?>
        </p>

        <p>
            Zona horaria anterior: <?php echo $zona_anterior; ?>
            Hora anterior: <?php echo $hora_anterior; ?>
        </p>

        <a href="index.html">Volver</a>

    </body>
</html>
