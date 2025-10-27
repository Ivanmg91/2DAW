<?php

    $correo = isset($_POST['correo']) ? $_POST['correo'] : null;
    $confirmacion = isset($_POST['confirmacion']) ? $_POST['confirmacion'] : null;
    $publicidad = isset($_POST['publicidad']);

    if ($correo !== $confirmacion) {
        echo "Ambos correos no coinciden.";
    } else if ($correo === $confirmacion) {
        echo "Correo: " . $correo . "<br>";

        if ($publicidad === true) {
            echo "Has aceptado recibir publicidad";
        } else if ($publicidad == false) {
            echo "No has aceptado recibir publicidad";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejer8</title>
</head>
<body>
    <p><a href="index.html"><?php echo "Volver"; ?></a></p>
</body>
</html>

