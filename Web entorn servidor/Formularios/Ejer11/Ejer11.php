<?php
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
    $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : null;
    $nivelEstudio = isset($_POST['nivel-estudio']) ? $_POST['nivel-estudio'] : null;
    $nacionalidad = isset($_POST['nacionalidad']) ? $_POST['nacionalidad'] : null;
    $idiomas = isset($_POST['idiomas']) ? $_POST['idiomas'] : [];
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $imagen = isset($_POST['imagen']) ? $_POST['imagen'] : null;

    echo "<h2>$nombre $apellidos</h2>";
    echo "$email<br>";
    echo "Nivel de estudio: $nivelEstudio<br>";
    echo "Nacionalidad: $nacionalidad<br>";
    echo "Idiomas: ";
    foreach ($idiomas as $idioma) {
        echo $idioma . " ";
    }

    echo $imagen;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejer10</title>
</head>
<body>
    <p><a href="index.html"><?php echo "Volver"; ?></a></p>
</body>
</html>
